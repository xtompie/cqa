<?php

namespace App\Sso\Command;

use App\Core\Command\Result;

class RegisterUserCommandValidator
{
    public function validate(RegisterUserCommand $command): Result|null
    {
        if (strlen($command->email()) == 0) {
            return Result::ofErrorMsg('Email required', 'email');
        }

        if (validator(['e' => $command->email()], ['e' => 'email'])->fails()) {
            return Result::ofErrorMsg('Invalid email format', 'email');
        }

        if (strlen($command->pass()) == 0) {
            return Result::ofErrorMsg('Password required', 'pass');
        }
    }
}
