<?php

namespace App\Sso\Listener;

use App\Sso\Command\SendRegistrationMailCommand;
use App\Sso\Event\UserRegistredEvent;

class SendRegistrationEmailListener
{
    public function __invoke(UserRegistredEvent $event)
    {
        (new SendRegistrationMailCommand($event->id()))->execute();
    }
}
