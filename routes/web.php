<?php

use Illuminate\Support\Facades\Artisan;

// if (!defined('STDIN')) {
//   define('STDIN', fopen('php://stdin', 'r'));
// }
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/[{lang}]', function ($lang='fa') {
//     app()->setlocale($lang);
//     return view('home');
// });
$router->get('/','HomeController@index');
// $router->get('/migrate', function () {
//     return Artisan::call('migrate', ["--force" => true ]);
// });
// $router->get('/seed', function () {
//     return Artisan::call('db:seed',['--class' => 'DatabaseSeeder','--force' => true ]);
// });


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['middleware' => 'jwt'], function () use ($router) {
        $router->post('me', 'UserController@Me');
        $router->post('profile','UserController@Profile');
        $router->post('update-info','UserController@Update');
        $router->post('message', 'MessageController@List');
        $router->post('credit-add', 'BankController@Add');
        $router->post('credit-list', 'BankController@List');
        $router->post('credit-update', 'BankController@Update');
        $router->post('credit-delete', 'BankController@Delete');
        $router->post('wallet', 'WalletController@Wallet');
        $router->post('pre-deposit', 'WalletController@PreDeposit');
        $router->post('withdraw', 'WalletController@Withdraw');
        $router->post('deposit', 'WalletController@Deposit');
        $router->post('coins', 'CoinsController@Coins');
        $router->post('level', 'LevelController@Level');
        $router->post('kyc', 'LevelController@Kyc');
    });

    $router->post('login','UserController@Login');
    $router->post('verify','UserController@Verify');
});

$router->group(['prefix' => 'admin'], function () use ($router) {
    $router->group(['middleware' => 'admin'], function () use ($router ) {
        $router->post('me', 'AdminController@Me');
        $router->post('list', 'DataController@List');
        $router->post('add', 'DataController@Add');
        $router->post('update', 'DataController@Update');
        $router->post('delete', 'DataController@Delete');
        $router->post('add-news', 'NewsController@Add');
        $router->post('update-news', 'NewsController@Update');
    });
    $router->get('refresh-coins','CoinsController@Refresh');
    $router->post('login','AdminController@Login');
});

