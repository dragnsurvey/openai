<?php

namespace Dragnsurvey\OpenAi\Tests\Unit;

use Dragnsurvey\OpenAi\Client;
use Dragnsurvey\OpenAi\Chat\ChatRequest;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use Orchestra\Testbench\TestCase;

class ClientTest extends TestCase
{

    private function createClientWithMockHandler(MockHandler $mockHandler): Client
    {
        $handlerStack = HandlerStack::create($mockHandler);
        $guzzleClient = new GuzzleClient(['handler' => $handlerStack]);

        $client = new Client();
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($client, $guzzleClient);

        return $client;
    }
    public function testGetMethodSuccess()
    {
        $mock = new MockHandler([new Response(200, [], json_encode(['data' => 'test']))]);
        $client = $this->createClientWithMockHandler($mock);

        $response = $client->get('resource');
        $this->assertEquals('test', $response->data);
    }

    public function testGetMethodFailure()
    {
        $mock = new MockHandler([
            new RequestException("Error Communicating with Server", new \GuzzleHttp\Psr7\Request('GET', 'test'))
        ]);
        $client = $this->createClientWithMockHandler($mock);

        $response = $client->get('resource');
        $this->assertNull($response);
    }

    public function testPostMethod()
    {
        $mock = new MockHandler([new Response(200, [], json_encode(['success' => true]))]);
        $client = $this->createClientWithMockHandler($mock);

        $chatRequest = new ChatRequest();
        // Set up your ChatRequest or ImageRequest object as needed

        $response = $client->post('resource', $chatRequest);
        $this->assertTrue($response->success);
    }
}
