<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Laravel\Lumen\Routing\Router;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
| 
| 
*/

/**
 * ! always update the router map when any endpoint changes
 */

$attr = [
    'prefix'=>'api'
];

$router->group($attr, function(Router $api){

    $api->group(['prefix' => 'authentication'], fn(Router $authentication)=>require base_path('routes/api/authentication.php'));
    $api->group(['prefix' => 'transaction'], fn(Router $transaction)=>require base_path('routes/api/transaction.php'));
    $api->group(['prefix' => 'account'], fn(Router $account)=>require base_path('routes/api/account.php'));

});
