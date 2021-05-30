<?php

namespace App\Core\Query;

interface MiddlewareInterface
{
    public function ask(object $query, callable $next): ?object;
}
