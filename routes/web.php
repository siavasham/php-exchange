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
        $router->post('address', 'WalletController@Address');
        $router->post('wallet', 'WalletController@Wallet');
        $router->post('withdraw', 'WalletController@Withdraw');
        $router->post('statistics', 'WalletController@Statistics');
        $router->post('wallet-coin', 'WalletController@Coin');
        $router->post('referrals','ReferralController@referrals');
        $router->post('tickets','TicketController@tickets');
        $router->post('profile','UserController@Profile');
        $router->post('update-info','UserController@Update');
        $router->post('change-password','UserController@ChangePass');
        $router->post('new-ticket','TicketController@newTicket');
        $router->post('view-ticket','TicketController@viewTicket');
        $router->post('replay-ticket','TicketController@replayTicket');
        $router->post('investing','InvestController@start');
        $router->post('invest-history','InvestController@history');
    });

    $router->post('register','UserController@Register');
    $router->post('login','UserController@Login');
    $router->post('activate','UserController@Active');
    $router->post('forget','UserController@Forget');
    
    $router->get('plans','PlansController@plans');
    $router->get('plans/{plan}','PlansController@plan');
    $router->get('coins','CoinsController@coins');

    $router->post('hook','HookController@index');
    $router->get('hook','HookController@get');
});

