<?php

namespace App\Core\Event;

class EventBus
{
    protected $listeners;

    public static function instance(): EventBus
    {
        return new EventBus;
    }

    public function __construct()
    {
        $this->listeners = EventListeners::listeners();
    }

    public function publish(object $event)
    {
        $name = get_class($event);
        if (!array_key_exists($name, $this->listeners)) {
            return;
        }
        foreach ((array)$this->listeners[$name] as $index => $listener) {
            if (is_string($listener)) { 
                $listener = new $listener;
                $this->listeners[$name][$index]  = $listener;
            }
            call_user_func($listener, $event);
        }
    }

    public function on($eventName, $callback)
    {
        $this->listeners[$eventName][] = $callback;
    }
}
