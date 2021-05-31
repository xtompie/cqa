<?php

namespace App\Sso\Command;

use App\Core\Command\Result;
use App\Soo\Command\SendRegistration\Context;
use App\Soo\Command\SendRegistration\Step1;
use App\Soo\Command\SendRegistration\Step2;
use Closure;
use Xtompie\Lainstance\Instance;

class SendRegistrationMailCommandHandler
{
    use Instance;

    public function execute(SendRegistrationMailCommand $command): void
    {
        return ($this->chain($this->middlewares()))(new Context($command, Result::ofSuccess()));
    }

    protected function middlewares(): array
    {
        return [
            Step1::instance(),
            Step2::instance(),
        ];
    }

    protected function chain($middlewares): Closure
    {
        $chain = static fn () => null;
        while ($middleware = array_pop($middlewares)) {
            $chain = static fn (Context $context) => $middleware->execute($context, $chain);
        }
        return $chain;
    }

}