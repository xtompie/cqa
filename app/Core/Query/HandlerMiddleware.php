<?php

namespace App\Core\Query;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class HandlerMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function ask(object $query, callable $next): ?object 
    {
        $handler = HandlerProvider::instance()->provide($query);
        return $handler->ask($query);
    }
}
