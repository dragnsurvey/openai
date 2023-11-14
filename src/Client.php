<?php

namespace Dragnsurvey\OpenAi;


use Dragnsurvey\OpenAi\Image\ImageRequest;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Dragnsurvey\OpenAi\Chat\ChatRequest;

class Client
{

    protected  $client;
    protected $base_url;
    public function __construct(){
        $this->client = new GuzzleClient([
            "headers" => [
                'Authorization'=> 'Bearer '.config("openai.api_key"),
                'Content-type' => 'application/json'
            ]
        ]);
        $this->base_url = "https://api.openai.com/v1/";
    }

    public function get(string $resource, array $params = []){

        $query = "";
        if(count($params) > 0){
            $query = "?".http_build_query($params);
        }

        try{
          $response = $this->client->get($this->base_url.$resource.$query);
          return  json_decode($response->getBody()->getContents());
        }catch (RequestException $e){
            Log::error($e->getMessage());
        }
    }

    public function post(string $resource, ChatRequest|ImageRequest $params){

        try{
            $response = $this->client->post($this->base_url.$resource,[
                "body" => json_encode($params)
            ] );

            return  json_decode($response->getBody()->getContents());
        }catch (RequestException $e){
            Log::error($e->getMessage());
        }
    }

}
