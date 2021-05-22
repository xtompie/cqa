<?php

namespace App\Core\Event;

class EventListeners
{

    public static function listeners(): array
    {
        return array_merge(...[
            \App\Sso\Listener\EventListeners::listeners(),
        ]);
    }
}
