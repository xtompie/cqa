<?php

namespace App\Core\Event;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class PublisherMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function __construct(
        protected ListenerProvider $listeners,
    ) {}

    public function publish(object $event, callable $next)
    {
        foreach ($this->listeners->provide($event) as $listener) {
            call_user_func($listener, $event);
        }
    }
}
