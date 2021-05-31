<?php

namespace App\Soo\Command\SendRegistration;

use App\Core\Command\Result;
use Xtompie\Lainstance\Instance;

class Step1 implements MiddlewareInterface
{
    use Instance;

    public function execute(Context $context, callable $next)
    {
        dump($context->command());
        return $next($context->withResult(Result::ofErrorMsg('Internal')));
    }
}
