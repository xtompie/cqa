<?php

namespace App\Core\Query;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class MemoMiddleware implements MiddlewareInterface, Shared
{
    use Instance;

    public function __construct( 
        protected MemoStorage $storage,
        protected HandlerProvider $handlers,
    ) {}

    public function ask(object $query, callable $next): ?object 
    {
        $memorable = $this->handlers->provide($query) instanceof MemoInterface;

        if ($memorable) {
            $identity = $this->identify($query);
            if ($this->storage->has($identity)) {
                return $this->storage->get($identity);
            }
        }

        $result = $next($query);

        if ($memorable) {
            $this->storage->set($identity, $result);
        }
        
        return $result;
    }

    protected function identify(object $query): string
    {
        return $query instanceof MemoIdentifyInterface 
            ? $query->memoIdentify($query) 
            : sha1(serialize($query))
        ;
    }
}
