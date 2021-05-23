<?php

namespace App\Core\Event;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class EventPublisherMiddleware implements EventMiddlewareInterface, Shared
{
    use Instance;

    public function __construct(
        protected EventListenerProvider $listeners,
    ) {}

    public function publish(object $event, callable $next)
    {
        foreach ($this->listeners->provide($event) as $listener) {
            call_user_func($listener, $event);
        }
    }
}
