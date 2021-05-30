<?php

namespace App\Core\Command;

interface MiddlewareInterface
{
    public function execute(object $command, callable $next): ?object;
}
