<?php

namespace App\Core\Event;

interface EventMiddlewareInterface
{
    public function publish(object $event, callable $next);
}
