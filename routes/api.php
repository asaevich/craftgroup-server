<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use function FastRoute\simpleDispatcher;

return simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->post('/join', AuthController::class);
    $r->get('/users', UserController::class);
});