<?php

use JiNexus\Mvc\Application\Factory\ApplicationFactory;

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * This makes our life easier when dealing with paths.
 * Everything is relative to the application root now.
 */
define('APP_ROOT_DIR', dirname(__DIR__));
chdir(APP_ROOT_DIR);

// Composer autoload
include __DIR__ . '/../vendor/autoload.php';

// Retrieve configuration
$appConfig = require __DIR__ . '/../config/application.config.php';

$app = ApplicationFactory::build($appConfig);
$app->run();