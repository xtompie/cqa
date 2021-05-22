<?php

namespace App\Sso\Listener;

use App\Sso\Event\UserRegistredEvent;

class EventListeners
{
    public static function listeners(): array
    {
        return [
            UserRegistredEvent::class => [
                SendRegistrationEmailListener::class,
            ]
        ];
    }
}
