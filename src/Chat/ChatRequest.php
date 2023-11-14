<?php

namespace Dragnsurvey\OpenAi\Chat;
use Dragnsurvey\OpenAi\Client;
use Dragnsurvey\OpenAi\Exceptions\NoMessagesException;

class ChatRequest
{

    /**
     * @var array A list of messages comprising the conversation so far.
     */
    public array $messages = [];

    /**
     * @var string ID of the model to use. Check the model endpoint compatibility table for details.
     */
    public string $model = "gpt-3.5-turbo";

    /**
     * @var float|null Frequency penalty to apply, between -2.0 and 2.0. Defaults to 0.
     */
    public ?float $frequency_penalty = 0;

    /**
     * @var array|null Modify the likelihood of specified tokens appearing in the completion.
     *                 Maps tokens (specified by their token ID) to an associated bias value.
     *                 Defaults to null.
     */
    public ?array $logit_bias;

    /**
     * @var int|null The maximum number of tokens to generate in the chat completion. Defaults to INF.
     */
    public ?int $max_tokens;

    /**
     * @var int|null Number of chat completion choices to generate for each input message. Defaults to 1.
     */
    public ?int $n = 1;

    /**
     * @var float|null Presence penalty to apply, between -2.0 and 2.0. Defaults to 0.
     */
    public ?float $presence_penalty;

    /**
     * @var object|null The format in which the generated images are returned.
     *                  Defaults to an object specifying 'url' or 'b64_json'.
     */
    public ?object $response_format;

    /**
     * @var int|null If specified, the system will attempt to sample deterministically. Defaults to null.
     */
    public ?int $seed;

    /**
     * @var mixed Sequences where the API will stop generating further tokens. Defaults to null.
     */
    public $stop; // mixed type (string/array/null)

    /**
     * @var bool|null If set to true, partial message deltas will be sent. Defaults to false.
     */
    public ?bool $stream;

    /**
     * @var float|null Sampling temperature to use, between 0 and 2. Defaults to 1.
     */
    public ?float $temperature;

    /**
     * @var float|null Nucleus sampling value, where only the tokens comprising the top 'n' percent
     *                 probability mass are considered. Defaults to 1.
     */
    public ?float $top_p;

    /**
     * @var array|null A list of tools the model may call. Defaults to null.
     */
    public ?array $tools;



    /**
     * @var string|null A unique identifier representing the end-user. Defaults to null.
     */
    public ?string $user;


    public function __construct()
    {

    }

    /**
     * Adds a system message to the messages array.
     *
     * This function appends a new system message to the messages array. It ensures
     * that the system message is the first message in the array. If there are already
     * other messages present, an exception is thrown.
     *
     * @param string $message The content of the system message to be added. The message
     *                        is trimmed before being added to ensure no leading/trailing
     *                        whitespace.
     *
     * @throws \Exception if there are already other messages in the messages array,
     *                    indicating that the system message is not the first message.
     *
     * @return void
     */
    public function addSystemMessage($message): void{
        if(count($this->messages) > 0){
            throw new \Exception("System message should be the first message");
        }
        $this->messages[] = ['role' => 'system', 'content' => trim($message)];
    }

    /**
     * Adds a user message to the messages array.
     *
     * This function appends a new message with the 'user' role to the messages array.
     * The message is trimmed to remove any leading or trailing whitespace before being added.
     *
     * @param string $message The user message to be added. The message is trimmed
     *                        before being added to the array.
     *
     * @return void
     */
    public function addUserMessage($message): void{
        $this->messages[] = ['role' => 'user', 'content' => trim($message)];
    }

    /**
     * Adds an assistant message to the messages array.
     *
     * This function appends a new message with the 'assistant' role to the messages array.
     * The message is trimmed to remove any leading or trailing whitespace before being added.
     *
     * @param string $message The assistant message to be added. The message is trimmed
     *                        before being added to the array.
     *
     * @return void
     */
    public function addAssistantMessage($message): void{
        $this->messages[] = ['role' => 'assistant', 'content' => trim($message)];
    }


    /**
     * Sets the model ID for the Chat API request.
     *
     * This method assigns a specific model ID to be used in the Chat API request. The model ID
     * should be a valid identifier as per the model endpoint compatibility table. It's crucial
     * to ensure that the provided model ID is compatible with the Chat API.
     *
     * @param string $model The model ID to be used in the Chat API request. This should be a
     *                      valid string identifier corresponding to a model compatible with
     *                      the Chat API.
     *
     *
     * @return void
     */
    public function setModel(string $model) :void{
        $this->model = $model;
    }


    public function send(){
        if(count($this->messages) === 0){
            throw new NoMessagesException();
        }
        $client = new Client();
        return $client->post('chat/completions', $this);
    }
}
