<?php

namespace App\Core\Command;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class HandlerMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, callable $next): ?object 
    {
        $handler = HandlerProvider::instance()->provide($command);
        return $handler->execute($command);
    }
}
