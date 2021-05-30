<?php

namespace App\Core\Command;

use RuntimeException;

class ErrorException extends RuntimeException implements Exception
{
    public static function ofErrorMsg(string $msg, string|null $key = null)
    {
        return (new self($msg))->setKey($key);
    }

    protected $key;

    public function setKey(string|null $key): self
    {
        $this->key = $key;
        return $this;
    }

    public function getKey(): string|null
    {
        return $this->key;
    }

}
