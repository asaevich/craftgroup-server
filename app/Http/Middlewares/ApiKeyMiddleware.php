<?php

namespace App\Http\Middlewares;

use App\Models\User;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Middlewares\Utils\Factory;

class ApiKeyMiddleware implements MiddlewareInterface
{
    private array $routes;
    private ResponseFactoryInterface $responseFactory;

    public function __construct(array $routes, ResponseFactoryInterface $responseFactory = null)
    {
        $this->routes = $routes;
        $this->responseFactory = $responseFactory ?: Factory::getResponseFactory();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!in_array($request->getUri()->getPath(), $this->routes)) {
            return $handler->handle($request);
        }

        if (key_exists('key', $request->getQueryParams())) {
            $key = $request->getQueryParams()['key'];
        } else {
            return $this->responseFactory->createResponse(401, 'No API key passed');
        }

        if (is_null($key)) {
            return $this->responseFactory->createResponse(401, 'No API key passed');
        }

        if (!User::where('key', '=', $key)->exists()) {
            return $this->responseFactory->createResponse(401, 'Invalid API key');
        }

        return $handler->handle($request);
    }
}