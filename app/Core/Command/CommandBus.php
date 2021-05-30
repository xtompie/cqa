<?php

namespace App\Core\Command;

use Closure;
use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class CommandBus implements Shared
{
    use Instance;

    protected Closure $chain;

    public function __construct()
    {
        $this->chain = $this->chain($this->middlewares());
    }

    public function execute(object $command)
    {
        return ($this->chain)($command);
    }

    protected function middlewares(): array
    {
        return [
            CommandValidateMiddleware::instance(),
            CommandEventsMiddleware::instance(),
            CommandDebugMiddleware::instance(),
            CommandDbTransactionMiddleware::instance(),
            CommandHandlerMiddleware::instance(),
        ];
    }

    protected function chain($middlewares): Closure
    {
        $chain = static fn () => null;
        while ($middleware = array_pop($middlewares)) {
            $chain = static fn ($command) => $middleware->execute($command, $chain);
        }
        return $chain;
    }
}
