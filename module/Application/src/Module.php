<?php
/**
 * @link      http://github.com/jinexus-framework/JiNexusSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2017 JiNexus Technologies Inc. (http://www.jinexus.com)
 * @license   http://framework.jinexus.com/license/new-bsd New BSD License
 */

declare(strict_types=1);

namespace Application;

use JiNexus\ModuleManager\ModuleManager\AbstractModule;

class Module extends AbstractModule
{
    const string VERSION = '1.1.0';

    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
