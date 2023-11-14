<?php

namespace Dragnsurvey\OpenAi\Exceptions;

class NoMessagesException extends \Exception
{
    /**
     * Construct the exception.
     *
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param \Throwable $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct(string $message = "No messages found", int $code = 101, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
