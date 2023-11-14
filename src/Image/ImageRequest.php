<?php

namespace Dragnsurvey\OpenAi\Image;

use Dragnsurvey\OpenAi\Client;

class ImageRequest
{
    /**
     * @var string A text description of the desired image(s).
     *             Maximum length is 1000 characters for dall-e-2 and 4000 characters for dall-e-3.
     */
    public string $prompt;

    /**
     * @var string The model to use for image generation. Defaults to 'dall-e-2'.
     */
    public string $model = 'dall-e-2';

    /**
     * @var int|null The number of images to generate. Must be between 1 and 10.
     *               For dall-e-3, only n=1 is supported. Defaults to 1.
     */
    public ?int $n = 1;

    /**
     * @var string The quality of the image that will be generated.
     *             'hd' creates images with finer details. Defaults to 'standard'.
     *             This parameter is only supported for dall-e-3.
     */
    public string $quality = 'standard';

    /**
     * @var string|null The format in which the generated images are returned.
     *                  Must be 'url' or 'b64_json'. Defaults to 'url'.
     */
    public ?string $response_format = 'url';

    /**
     * @var string|null The size of the generated images.
     *                  Defaults to '1024x1024'. For dall-e-2, options are '256x256', '512x512', or '1024x1024'.
     *                  For dall-e-3, options are '1024x1024', '1792x1024', or '1024x1792'.
     */
    public ?string $size = '1024x1024';

    /**
     * @var string|null The style of the generated images.
     *                  Defaults to 'vivid'. Options are 'vivid' or 'natural'.
     *                  This parameter is only supported for dall-e-3.
     */
    public ?string $style = 'vivid';

    /**
     * @var string A unique identifier representing the end-user, used for monitoring and abuse detection.
     */
    public string $user;


    public function __construct(string|null $prompt = null){
        if(!empty($prompt)){
            $this->prompt = $prompt;
        }
    }


    public function setPrompt(string $prompt): void{
        $this->prompt = $prompt;
    }

    public function setModel(string $model): void{
        $this->model = $model;
    }

    public function send(){
        $client = new Client();
        return $client->post('images/generations', $this);
    }


}
