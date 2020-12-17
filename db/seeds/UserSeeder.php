<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $binary_photo = file_get_contents(__DIR__ . '/img/user_photo.jpg');
        $base64_photo = base64_encode($binary_photo);
        $data = [
            [
                'name' => 'Сергей',
                'email' => 'sergei@example.ru',
                'photo' => $base64_photo,
                'key' => uniqid(more_entropy: true),
            ],
            [
                'name' => 'Андрей',
                'email' => 'andrei@example.ru',
                'photo' => $base64_photo,
                'key' => uniqid(more_entropy: true),
            ],
            [
                'name' => 'Анна',
                'email' => 'anna@example.ru',
                'photo' => $base64_photo,
                'key' => uniqid(more_entropy: true),
            ],
            [
                'name' => 'Михаил',
                'email' => 'mihail@example.ru',
                'photo' => $base64_photo,
                'key' => uniqid(more_entropy: true),
            ],
            [
                'name' => 'Андрей',
                'email' => 'andrei_new@example.ru',
                'photo' => $base64_photo,
                'key' => uniqid(more_entropy: true),
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)->saveData();
    }
}
