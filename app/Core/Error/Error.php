<?php

namespace App\Core\Error;

class Error
{
    public function __construct(
        protected string $message,
        protected string $key,
    ) {}

    public function message(): string
    {
        return $this->message;
    }

    public function key(): string
    {
        return $this->key;
    }
}
