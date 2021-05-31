<?php

namespace App\Soo\Command\SendRegistration;

interface MiddlewareInterface
{
    public function execute(Context $context, callable $next);
}
