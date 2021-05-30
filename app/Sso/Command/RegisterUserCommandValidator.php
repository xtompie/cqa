<?php

namespace App\Sso\Command;

use App\Core\Command\CommandResult;

class RegisterUserCommandValidator
{
    public function validate(RegisterUserCommand $command): CommandResult|null
    {
        if (strlen($command->email()) == 0) {
            return CommandResult::ofErrorMsg('Email required', 'email');
        }

        if (validator(['e' => $command->email()], ['e' => 'email'])->fails()) {
            return CommandResult::ofErrorMsg('Invalid email format', 'email');
        }

        if (strlen($command->pass()) == 0) {
            return CommandResult::ofErrorMsg('Password required', 'pass');
        }
    }
}
