<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        if (key_exists('order', $request->getQueryParams())) {
            $order = $request->getQueryParams()['order'];
        } else {
            $order = 'name';
        }
        return new JsonResponse(User::orderBy($order)->get());
    }
}