<?php

namespace App\Core\Command;

use App\Core\Error\ErrorCollection;
use Error;

class Result implements PublishesEventsInterface
{
    public static function new(): static
    {
        return new static(false, null, ErrorCollection::ofEmpty(), []);
    }

    public static function ofSuccess($events = []): static
    {
        return self::new()->withSuccess()->withEvents($events);
    }

    public static function ofErrors(ErrorCollection $errors): static
    {
        return self::new()->withErrors($errors);
    }

    public static function ofError(Error $error): static
    {
        return self::new()->withError($error);
    }

    public static function ofErrorMsg(string $msg, string $key = null): static
    {
        return self::new()->withErrorMsg($msg, $key);
    }

    final public function __construct(
        protected bool $success,
        protected string|null $resource,
        protected ErrorCollection $errors,
        protected array $events,
    ) {}

    public function withSuccess(): static
    {
        $clone = clone $this;
        $clone->success = true;
        return $clone;
    }

    public function withErrors(ErrorCollection $errors): static
    {
        $clone = clone $this;
        $clone->errors = $errors;
        return $clone;
    }

    public function withError($error)
    {
        return $this->withErrors(new ErrorCollection([$error]));
    }

    public function withErrorMsg($message, $key = null)
    {
        return $this->withError(new Error($message, $key));
    }

    public function withEvents(array $events): static
    {
        $clone = clone $this;
        $clone->events = $events;
        return $clone;
    }

    public function withEvent(object $event): static
    {
        return $this->withEvents([$event]);
    }

    public function success(): bool
    {
        return $this->success;
    }
    
    public function resource(): string
    {
        return $this->resource;
    }
    
    public function errors(): ErrorCollection
    {
        return $this->errors ?: ErrorCollection::ofEmpty();
    }
    
    public function events(): array
    {
        return $this->events;
    }
}
