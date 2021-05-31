<?php

namespace App\Soo\Command\SendRegistration;

use App\Core\Command\Result;
use App\Sso\Command\SendRegistrationMailCommand;

class Context
{
    public function __construct(
        protected SendRegistrationMailCommand $command,
        protected Result $result,
    ) {}

    public function command(): SendRegistrationMailCommand
    {
        return $this->command;
    }

    public function withResult(Result $result)
    {
        $this->result = $result;
    }

    public function result(): Result
    {
        return $this->result;
    }

}
