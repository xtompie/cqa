<?php

namespace App\Core\Command;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class ErrorExceptionToResultMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, $next): ?object 
    {
        try {
            return $next($command);
        } 
        catch (ErrorException $e) {
            return Result::ofErrorMsg($e->getMessage(), $e->getKey());
        }
    }
}
