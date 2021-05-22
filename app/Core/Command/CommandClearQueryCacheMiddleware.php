<?php

namespace App\Core\Command;

use App\Core\Query\QueryMemoStorage;
use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class CommandClearQueryCacheMiddleware implements CommandMiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, $next): ?object 
    {
        $result = $next($command);

        QueryMemoStorage::instance()->clear();

        return $result;
    }
}
