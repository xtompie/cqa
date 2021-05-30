<?php

namespace App\Core\Command;

use App\Core\Query\MemoStorage;
use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class MemoCleanerMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, $next): ?object 
    {
        $result = $next($command);

        MemoStorage::instance()->clear();

        return $result;
    }
}
