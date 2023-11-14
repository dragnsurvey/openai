<?php

namespace Dragnsurvey\OpenAi\Tests\Unit;

use Dragnsurvey\OpenAi\Chat\ChatRequest;
use Dragnsurvey\OpenAi\Exceptions\NoMessagesException;
use GuzzleHttp\Handler\MockHandler;
use Orchestra\Testbench\TestCase;

class ChatRequestTest extends TestCase
{
    public function testAddSystemMessage()
    {
        $chatRequest = new ChatRequest();
        $chatRequest->addSystemMessage('System message');

        $this->assertEquals([['role' => 'system', 'content' => 'System message']], $chatRequest->messages);
    }

    public function testAddSystemMessageAsFirstOnly()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('System message should be the first message');

        $chatRequest = new ChatRequest();
        $chatRequest->addUserMessage('User message');
        $chatRequest->addSystemMessage('System message');
    }

    public function testAddUserMessage()
    {
        $chatRequest = new ChatRequest();
        $chatRequest->addUserMessage('User message');

        $this->assertEquals([['role' => 'user', 'content' => 'User message']], $chatRequest->messages);
    }

    public function testAddAssistantMessage()
    {
        $chatRequest = new ChatRequest();
        $chatRequest->addAssistantMessage('Assistant message');

        $this->assertEquals([['role' => 'assistant', 'content' => 'Assistant message']], $chatRequest->messages);
    }

    public function testSetModel()
    {
        $chatRequest = new ChatRequest();
        $chatRequest->setModel('gpt-3.5');

        $this->assertEquals('gpt-3.5', $chatRequest->model);
    }

    public function testSendThrowsNoMessagesException()
    {
        $this->expectException(NoMessagesException::class);

        $chatRequest = new ChatRequest();
        $chatRequest->send();
    }

}
