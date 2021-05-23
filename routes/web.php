<?php

use App\Sso\Command\RegisterUserCommand;
use App\Sso\Query\UserQuery;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $result = (new RegisterUserCommand('test@example.com', '1234'))->execute();
    print_r($result);

    $response = (new UserQuery('1234'))->ask();
    print_r($response);

    
    
    return '';
});
