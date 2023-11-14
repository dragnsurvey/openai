<?php

namespace Dragnsurvey\OpenAi\Tests\Unit;

use Dragnsurvey\OpenAi\Image\ImageRequest;
use Dragnsurvey\OpenAi\Client;
use Orchestra\Testbench\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client as GuzzleClient;

class ImageRequestTest extends TestCase
{
    public function testConstructor()
    {
        $imageRequest = new ImageRequest('Sample prompt');
        $this->assertEquals('Sample prompt', $imageRequest->prompt);
    }

    public function testSetPrompt()
    {
        $imageRequest = new ImageRequest();
        $imageRequest->setPrompt('New prompt');
        $this->assertEquals('New prompt', $imageRequest->prompt);
    }

    public function testSetModel()
    {
        $imageRequest = new ImageRequest();
        $imageRequest->setModel('dall-e-3');
        $this->assertEquals('dall-e-3', $imageRequest->model);
    }

}
