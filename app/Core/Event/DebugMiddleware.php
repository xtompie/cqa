<?php

namespace App\Core\Event;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class DebugMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function publish(object $event, $next): ?object 
    {
        $debug = config('app.debug');

        if ($debug) {
            debugbar()->addMessage($event, 'event');
            debugbar()->addMessage(
                [
                    'event' => $event::class,
                    'listeners' => ListenerProvider::instance()->provide($event),
                ],
                'listeners'
            );
            
        }

        $result = $next($event);

        return $result;
    }
}
