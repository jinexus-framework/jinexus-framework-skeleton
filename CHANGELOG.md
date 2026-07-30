# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## v1.1.0 - 2026-07-30

### Added

- PHP 8.5 supports with `declare(strict_types=1)` across all source and test files.
- `Application\Module` extending `JiNexus\ModuleManager\ModuleManager\AbstractModule` with `getConfig()` returning routes and view-manager settings from `module.config.php`.
- `Application\Controller\IndexController` extending `JiNexus\Mvc\Controller\AbstractController` with a default `indexAction()` returning a `ViewModel`.
- Application route (`application.home`) mapped to the index controller.
- View templates: layout (`layout/layout.phtml`), index view, and error pages (`error/404.phtml`).
- PHPUnit 13 unit-test suite with `phpunit.dist.xml` covering `Module` and `IndexController` at 100% line, method, and class coverage.
- `ApplicationDouble` test fixture implementing `ApplicationInterface` for controller tests.
- `composer test` / `composer test:coverage` / `composer serve` scripts with descriptions.
- `AGENTS.md` with build, coding-standard, architecture, and workflow guidance.
- Expanded `README.md` with installation, directory layout, extending, and testing documentation.

### Changed

- Raised the minimum PHP requirement to `^8.5`; all classes use PHP 8.5 property hooks and typed properties.
- Updated `composer.json` `branch-alias` to `dev-main: 1.1.x-dev`.
- Changed test location from `module/Application/test/` to `test/Application/` (mirrors the module structure).
- Changed `phpunit.dist.xml` source coverage path to `module/Application/src` and test suite to `test/`.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- `Application\Module::getConfig()` return type corrected from `mixed` to `array` to match the parent `AbstractModule::getConfig(): array` signature.

## v1.0.0 - 2018-07-10

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
