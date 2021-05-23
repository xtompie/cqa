<?php

namespace App\Core\Event;

use Closure;
use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class EventBus implements Shared
{
    use Instance;

    protected Closure $chain;

    public function __construct() 
    {
        $this->chain = $this->chain($this->middlewares());
    }

    public function publish(object $event)
    {
        return ($this->chain)($event);
    }    

    protected function middlewares(): array
    {
        return [
            EventDebugMiddleware::instance(),
            EventPublisherMiddleware::instance(),
        ];
    }

    protected function chain($middlewares): Closure
    {
        $chain = static fn () => null;
        while ($middleware = array_pop($middlewares)) {
            $chain = static fn ($event) => $middleware->publish($event, $chain);
        }
        return $chain;
    }    
}
