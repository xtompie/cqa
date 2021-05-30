<?php

namespace App\Core\Query;

use Closure;
use Xtompie\Lainstance\Instance;

class QueryBus
{
    use Instance;

    public function __construct()
    {
        $this->chain = $this->chain($this->middlewares());
    }

    public function ask(object $query): object
    {
        return ($this->chain)($query);        
    }

    protected function middlewares(): array
    {
        return [
            MemoMiddleware::instance(),
            DebugMiddleware::instance(),
            HandlerMiddleware::instance(),
        ];
    }

    protected function chain($middlewares): Closure
    {
        $chain = static fn () => null;
        while ($middleware = array_pop($middlewares)) {
            $chain = static fn ($command) => $middleware->ask($command, $chain);
        }
        return $chain;
    }    

}
