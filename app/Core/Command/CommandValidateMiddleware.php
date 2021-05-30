<?php

namespace App\Core\Command;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class CommandValidateMiddleware implements CommandMiddlewareInterface, Shared
{
    use Instance;

    public function __construct(
        protected CommandHandlerProvider $handlers,
        protected CommandValidatorProvider $validators,
    ){ }

    public function execute(object $command, $next): ?object 
    {
        if ($this->handlers->provide($command) instanceof CommandValidateInterface) {
            $result = $this->validators->provide($command)->validate($command);
            if ($result) {
                return $result;
            }
        }

        return $next($command);
    }
}
