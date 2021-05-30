<?php

namespace App\Sso\Event;

use App\Core\Event\PublicInterface;

class UserRegistredEvent implements PublicInterface
{
    public function __construct(
        protected string $id
    ) {}

    public function id(): string
    {
        return $this->id;
    }
}
