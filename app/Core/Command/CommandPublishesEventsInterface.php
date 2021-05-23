<?php

namespace App\Core\Command;

interface CommandPublishesEventsInterface
{
    public function events(): array;
}