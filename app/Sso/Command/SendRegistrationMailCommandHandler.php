<?php

namespace App\Sso\Command;

use Xtompie\Lainstance\Instance;

class SendRegistrationMailCommandHandler
{
    use Instance;

    public function execute(SendRegistrationMailCommand $command): void
    {
        dump(__CLASS__);
    }
}