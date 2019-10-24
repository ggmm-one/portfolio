<?php

return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'localhost'),
    'port' => env('MAIL_PORT', 25),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'example@example.org'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME', 'Portfolio Management')),
    ],
    'encryption' => env('MAIL_ENCRYPTION'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => [
        'theme' => 'default',
        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],
];
