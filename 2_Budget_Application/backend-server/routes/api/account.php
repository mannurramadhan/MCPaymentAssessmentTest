<?php
/**
 * NOTE: make sure variable name is same as parent function arguments
 */

/** @var \Laravel\Lumen\Routing\Router $account */

use Laravel\Lumen\Routing\Router;

$account->get('/', "AccountController@fetchSummary");
