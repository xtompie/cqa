<?php

namespace App\Core\Command;

use App\Core\Event\EventBus;
use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class CommandEventsMiddleware implements CommandMiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, $next): ?object 
    {
        $result = $next($command);

        if ($result instanceof CommandPublishesEvents) {
            /** @var CommandPublishesEvents $result */
            foreach ($result->events() as $event) {
                EventBus::instance()->publish($event);
            }
        }

        return $result;
    }
}
