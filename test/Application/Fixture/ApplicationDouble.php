<?php

declare(strict_types=1);

namespace Application\Test\Fixture;

use JiNexus\Config\Config\ConfigInterface;
use JiNexus\Http\Http\HttpInterface;
use JiNexus\ModuleManager\ModuleManager\ModuleManagerInterface;
use JiNexus\Mvc\Application\ApplicationInterface;
use JiNexus\Mvc\Controller\ControllerInterface;
use JiNexus\Mvc\View\View;
use JiNexus\Mvc\View\ViewInterface;
use JiNexus\Route\Route\RouteInterface;
use RuntimeException;

final class ApplicationDouble implements ApplicationInterface
{
    public ConfigInterface $config;

    public mixed $actionName = null;

    public string $controllerName = '';

    public HttpInterface $http;

    public array $matchRoute = [];

    public ModuleManagerInterface $moduleManager;

    public string $moduleName = '';

    public mixed $namespace = null;

    public RouteInterface $route;

    public ViewInterface $view;

    public function __construct(ConfigInterface $config, HttpInterface $http, ModuleManagerInterface $moduleManager, RouteInterface $route)
    {
        $this->config = $config;
        $this->http = $http;
        $this->moduleManager = $moduleManager;
        $this->route = $route;
    }

    public function __call($property, array $arguments): null
    {
        return null;
    }

    public function dispatchAction($controller): void
    { }

    public function dispatchController(): ControllerInterface
    {
        throw new RuntimeException('Not implemented');
    }

    public function dispatchView(): View
    {
        throw new RuntimeException('Not implemented');
    }

    public static function error(int $number, string $string, string $file, int $line)
    { }

    public function renderView(): void
    { }

    public function run(): void
    { }
}
