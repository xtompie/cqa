<?php

namespace App\Sso\Query;

use App\Sso\Model\UserModel;
use Xtompie\Lainstance\Instance;

class UserQueryHandler
{
    use Instance;

    public function ask(UserQuery $query): UserQueryResponse
    {
        return new UserQueryResponse(
            true,
            new UserModel(['id' => $query->id(), 'email' => 'user@example.com']),
            [
                'foo' => 'bar'
            ],
        );
    }
}
