<?php
namespace Application;

use Application\Controller\IndexController;

return [
    'routes' => [
        'application.home' => [
            'route' => '/',
            'controller' => IndexController::class,
            'action' => 'index',
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'layout/layout' => 'layout/layout.phtml',
            'error/404' => 'error/404.phtml',
        ],
        'template_path_stack' => __DIR__ . '/../view',
    ],
];