<?php

namespace App\Soo\Command\SendRegistration;

use Xtompie\Lainstance\Instance;

class Step2 implements MiddlewareInterface
{
    use Instance;
 
    public function execute(Context $context, callable $next)
    {
        if (rand(0, 1) == 1) {
            return $context->result();
        }
        
        return $next($context);
    }
}
