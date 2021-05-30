<?php

namespace App\Sso\Command;

use App\Core\Command\CommandBus;
use App\Core\Command\Result;

class RegisterUserCommand
{
    public function __construct(
        protected string $email,
        protected string $pass
    ) {}

    public function email()
    {
        return $this->email;
    }

    public function pass()
    {
        return $this->pass;
    }

    public function execute(): Result
    {
        return CommandBus::instance()->execute($this);
    }
}
