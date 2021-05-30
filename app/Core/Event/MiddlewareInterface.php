<?php

namespace App\Core\Event;

interface MiddlewareInterface
{
    public function publish(object $event, callable $next);
}
