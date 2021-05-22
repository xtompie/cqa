<?php

namespace App\Core\Error;

use ArrayIterator;
use Illuminate\Support\Collection;
use IteratorAggregate;

class ErrorCollection implements IteratorAggregate 
{
    public static function ofEmpty(): static
    {
        return new static([]);
    }

    public function __construct(
        protected array $errors 
    ) {}

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->errors);
    }

    public function collect(): Collection
    {
        return new Collection($this->errors);
    }
}
