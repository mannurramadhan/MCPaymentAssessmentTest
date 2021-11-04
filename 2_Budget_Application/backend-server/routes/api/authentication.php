<?php
/**
 * NOTE: make sure variable name is same as parent function arguments
 */

/** @var \Laravel\Lumen\Routing\Router $authentication */

use Laravel\Lumen\Routing\Router;

$authentication->post('register', "Auth\RegisterController@register");
$authentication->post('login', "Auth\LoginController@login");