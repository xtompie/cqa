<?php

use App\Sso\Command\RegisterUserCommand;
use Illuminate\Support\Facades\Artisan;


Artisan::command('i', function () {
    

    $result = (new RegisterUserCommand('test@example.com', '1234'))->execute();

    dump($result);
    
});
