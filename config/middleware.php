<?php

return [

    'aliases' => [

        'auth' => \App\Http\Middleware\Authenticate::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'owner' => \App\Http\Middleware\OwnerMiddleware::class,

    ],
];
