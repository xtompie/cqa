<?php

namespace App\Core\Query;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class QueryDebugMiddleware implements QueryMiddlewareInterface, Shared
{
    use Instance;

    public function ask(object $query, $next): ?object 
    {
        $debug = config('app.debug');

        if ($debug) {
            debugbar()->addMessage($query, 'query');
            $start = now();
        }

        $result = $next($query);

        if ($debug) {
            debugbar()->addMessage(
                [
                    'query' => $query,
                    'time' => now()->diffInRealMilliseconds($start) .'ms',
                ],
                'time'
            );
        }

        return $result;
    }
}
