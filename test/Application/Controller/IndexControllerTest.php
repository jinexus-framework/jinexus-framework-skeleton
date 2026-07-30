<?php

declare(strict_types=1);

namespace Application\Test\Controller;

use Application\Controller\IndexController;
use Application\Test\Fixture\ApplicationDouble;
use JiNexus\Config\Config\Config;
use JiNexus\Http\Http\Http;
use JiNexus\Http\Request\Request;
use JiNexus\ModuleManager\ModuleManager\ModuleManager;
use JiNexus\Mvc\Model\ViewModel;
use JiNexus\Mvc\View\ViewInterface;
use JiNexus\Route\Route\Factory\RouteFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(IndexController::class)]
final class IndexControllerTest extends TestCase
{
    #[Test]
    public function index_action_returns_a_view_model_with_hello_world(): void
    {
        $config = new Config();
        $config->set('routes', ['application.home' => ['route' => '/']]);
        $config->set('view_manager', [
            'template_path_stack' => '',
            'template_map' => [
                'layout/layout' => '',
                'error/404' => '',
            ],
        ]);

        $request = new Request();
        $http = new Http($request);
        $moduleManager = new ModuleManager();
        $route = RouteFactory::build();
        $route->redirect->setRoutes($config->get('routes'));

        $app = new ApplicationDouble($config, $http, $moduleManager, $route);
        $app->view = $this->createStub(ViewInterface::class);

        $controller = new IndexController($app);
        $viewModel = $controller->indexAction();

        self::assertSame(ViewModel::class, $viewModel::class);
        self::assertSame(['helloWorld' => 'Hello World!'], $viewModel->getVariables());
    }
}
