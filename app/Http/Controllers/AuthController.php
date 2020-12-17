<?php

namespace App\Http\Controllers;

use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\TextResponse;
use Psr\Http\Message\ResponseInterface;
use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;

class AuthController
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();

        if (User::where('email', '=', $parsedBody['email'])->exists()) {
            return new JsonResponse(['error' => 'Email занят']);
        }

        $binary_photo = $request->getUploadedFiles()['photo']->getStream()->getContents();
        $base64_photo = base64_encode($binary_photo);

        $user = User::create([
            'name' => $parsedBody['name'],
            'email' => $parsedBody['email'],
            'photo' => $base64_photo,
            'key' => uniqid(more_entropy: true),
        ]);

        return new JsonResponse(['key' => $user->key]);
    }
}