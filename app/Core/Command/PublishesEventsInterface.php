<?php

namespace App\Core\Command;

interface PublishesEventsInterface
{
    public function events(): array;
}