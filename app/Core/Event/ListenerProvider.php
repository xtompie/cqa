<?php

namespace App\Core\Event;

use Xtompie\Lainstance\Instance;

class ListenerProvider
{
    use Instance;

    protected $listeners;

    public function __construct()
    {
        $this->listeners = $this->listeners();
    }

    protected function listeners(): array
    {
        return array_merge(...[
            \App\Sso\Listener\Listeners::listeners(),
        ]);
    }

    /**
     * @param object $event
     * @return array
     */
    public function provide($event)
    {
        $name = get_class($event);
        if (!array_key_exists($name, $this->listeners)) {
            return [];
        }
        foreach ($this->listeners[$name] as $index => $listener) {
            if (is_string($listener)) { 
                $listener = app($listener);
                $this->listeners[$name][$index]  = $listener;
            }
        }
        return $this->listeners[$name];
    }
}
