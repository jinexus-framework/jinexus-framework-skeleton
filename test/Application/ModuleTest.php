<?php

declare(strict_types=1);

namespace Application\Test;

use Application\Controller\IndexController;
use Application\Module;
use JiNexus\ModuleManager\ModuleManager\AbstractModule;
use JiNexus\ModuleManager\ModuleManager\ModuleInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Module::class)]
final class ModuleTest extends TestCase
{
    #[Test]
    public function it_is_a_valid_module(): void
    {
        self::assertContains(ModuleInterface::class, class_implements(Module::class));
        self::assertSame(AbstractModule::class, class_parents(Module::class)[AbstractModule::class]);
    }

    #[Test]
    public function it_has_a_version_constant(): void
    {
        self::assertSame('1.1.0', Module::VERSION);
    }

    #[Test]
    public function get_config_returns_the_merged_module_config(): void
    {
        $config = new Module()->getConfig();

        self::assertArrayHasKey('routes', $config);
        self::assertArrayHasKey('application.home', $config['routes']);
        self::assertSame(IndexController::class, $config['routes']['application.home']['controller']);

        self::assertArrayHasKey('view_manager', $config);
        self::assertArrayHasKey('template_map', $config['view_manager']);
        self::assertArrayHasKey('template_path_stack', $config['view_manager']);
    }
}
