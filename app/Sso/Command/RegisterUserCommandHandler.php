<?php

namespace App\Sso\Command;

use App\Core\Command\DbTransactionInterface;
use App\Core\Command\Result;
use App\Sso\Event\UserRegistredEvent;
use Xtompie\Lainstance\Instance;

class RegisterUserCommandHandler implements DbTransactionInterface
{
    use Instance;

    public function execute(RegisterUserCommand $command): Result
    {
        // $command->email();
        // $command->pass();
        $id = "1234";

        return Result::new()->withSuccess()->withEvents([
            new UserRegistredEvent($id),
        ]);
    }
}