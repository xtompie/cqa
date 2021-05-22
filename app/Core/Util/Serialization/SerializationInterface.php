<?php

namespace App\Core\Util\Serialization;

interface SerializationInterface
{
    public static function fromSerialization(string $serialization): static;
    public function toSerialization(): string;
}
