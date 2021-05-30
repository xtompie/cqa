<?php

namespace App\Core\Command;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class ValidateMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function __construct(
        protected HandlerProvider $handlers,
        protected ValidatorProvider $validators,
    ) {}

    public function execute(object $command, $next): ?object 
    {
        if ($this->handlers->provide($command) instanceof ValidateInterface) {
            $result = $this->validators->provide($command)->validate($command);
            if ($result) {
                return $result;
            }
        }

        return $next($command);
    }
}
