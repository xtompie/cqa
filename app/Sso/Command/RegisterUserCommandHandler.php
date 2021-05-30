<?php

namespace App\Sso\Command;

use App\Core\Command\CommandDbTransactionInterface;
use App\Core\Command\CommandResult;
use App\Sso\Event\UserRegistredEvent;
use Xtompie\Lainstance\Instance;

class RegisterUserCommandHandler implements CommandDbTransactionInterface
{
    use Instance;

    public function execute(RegisterUserCommand $command): CommandResult
    {
        // $command->email();
        // $command->pass();
        $id = "1234";

        return CommandResult::new()->withSuccess()->withEvents([
            new UserRegistredEvent($id),
        ]);
    }
}