<?php

namespace App\Core\Command;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class DebugMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, $next): ?object 
    {
        $debug = config('app.debug');

        if ($debug) {
            debugbar()->addMessage($command, 'command');
            $start = now();
        }

        $result = $next($command);

        if ($debug) {
            debugbar()->addMessage(
                [
                    'command' => $command,
                    'time' => now()->diffInRealMilliseconds($start) .'ms',
                ],
                'time'
            );
        }

        return $result;
    }
}
