<?php

namespace App\Core\Command;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class CommandHandlerMiddleware implements CommandMiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, callable $next): ?object 
    {
        $handler = CommandHandlerProvider::instance()->provide($command);
        return $handler->execute($command);
    }
}
