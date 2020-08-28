<?php

$router = $di->getRouter(false);

$router->add(
    '/',
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);

$router->add(
    '/signup',
    [
        'controller' => 'auth',
        'action'     => 'signup',
    ]
);

$router->add(
    '/login',
    [
        'controller' => 'auth',
        'action'     => 'login',
    ]
);

$router->add(
    '/logout',
    [
        'controller' => 'auth',
        'action'     => 'logout',
    ]
);

// Define your routes here
$router->notFound(
    [
        'controller' => 'error',
        'action'     => 'route404',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
