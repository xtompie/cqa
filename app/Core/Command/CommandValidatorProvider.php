<?php

namespace App\Core\Command;

use Xtompie\Lainstance\Instance;
use Xtompie\Lainstance\Shared;

class CommandValidatorProvider implements Shared
{
    use Instance;

    protected $validators = [];

    public function provide(object $command): object
    {
        if (!isset($this->validators[$command::class])) {
            $this->validators[$command::class] = $this->factory($command);
        }
        return $this->validators[$command::class];
    }

    protected function factory(object $command): object
    {
        $validator = $command::class . 'Validator';
        return $validator::instance();
    }
}