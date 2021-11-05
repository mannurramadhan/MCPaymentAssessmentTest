<?php
/**
 * NOTE: make sure variable name is same as parent function arguments
 */

/** @var \Laravel\Lumen\Routing\Router $transaction */

use Laravel\Lumen\Routing\Router;

$transaction->post('/', "TransactionController@store");
$transaction->get('/', "TransactionController@fetch");
$transaction->get('/{id}', "TransactionController@show");
$transaction->put('/{id}', "TransactionController@update");
