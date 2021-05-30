<?php

namespace App\Core\Command;

use App\Core\Event\EventBus;
use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class EventsPublisherMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, $next): ?object 
    {
        $result = $next($command);

        if ($result instanceof PublishesEventsInterface) {
            /** @var PublishesEventsInterface $result */
            foreach ($result->events() as $event) {
                EventBus::instance()->publish($event);
            }
        }

        return $result;
    }
}
