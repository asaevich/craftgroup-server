<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/config.php';

use App\Http\Middlewares\ApiKeyMiddleware;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Illuminate\Database\Capsule\Manager as Capsule;
use Middlewares\Utils\Dispatcher;

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => DB_DRIVER,
    'host'      => DB_HOST,
    'database'  => DB_NAME,
    'username'  => DB_USERNAME,
    'password'  => DB_PASSWORD,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$routeDispatcher = require dirname(__DIR__) . '/routes/api.php';
$dispatcher = new Dispatcher([
    new ApiKeyMiddleware(['/users']),
    new Middlewares\Recaptcha(CAPTCHA_KEY),
    new Middlewares\FastRoute($routeDispatcher),
    new Middlewares\RequestHandler()
]);

header('Access-Control-Allow-Origin: *');

$response = $dispatcher->dispatch(ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
));
$emitter = new SapiEmitter();
$emitter->emit($response);