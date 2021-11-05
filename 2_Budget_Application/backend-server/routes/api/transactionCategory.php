<?php
/**
 * NOTE: make sure variable name is same as parent function arguments
 */

/** @var \Laravel\Lumen\Routing\Router $transaction */

use Laravel\Lumen\Routing\Router;

$transaction->get('/', "TransactionController@fetch");
