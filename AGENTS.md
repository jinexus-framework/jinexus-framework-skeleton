# AGENTS.md

Guidance for AI coding agents (and humans) working in the `jinexus-framework/jinexus-framework-skeleton` package.
Read this before making changes.

## What this package is

The official skeleton application for the JiNexus Framework. It provides a ready-to-go
project structure for building MVC applications using the JiNexus Framework components
(mvc, http, route, config, module-manager).

The skeleton wires up a single `Application` module that registers routes, controllers,
view templates, and error pages. It includes a PHP built-in server script for development,
a preconfigured PHPUnit test suite, and the full directory layout (`config/`, `module/`,
`public/`, `data/`, `test/`) expected by a JiNexus application.

## Build & test commands

Run everything from the package root (the directory containing `composer.json`).

```bash
# Install dependencies
composer install

# Regenerate autoloader after adding/moving/renaming classes or namespaces
composer dump-autoload

# Run the full test suite (auto-discovers phpunit.dist.xml)
./vendor/bin/phpunit

# Equivalent via Composer scripts
composer test
composer test:coverage        # sets XDEBUG_MODE=coverage and prints a text report

# Silence the local Xdebug "could not connect" notice
XDEBUG_MODE=off ./vendor/bin/phpunit

# Readable, per-test output
XDEBUG_MODE=off ./vendor/bin/phpunit --testdox

# Run a single file
XDEBUG_MODE=off ./vendor/bin/phpunit test/Application/ModuleTest.php

# Run a single test by name (regex against method names)
XDEBUG_MODE=off ./vendor/bin/phpunit --filter index_action_returns_a_view_model_with_hello_world

# Start the development server via Composer
composer run --timeout=0 serve

# Start the development server directly
php -S localhost:8000 -t public
```

There is no build step — this is a project skeleton consumed via `composer create-project`.

## Project architecture

```
config/
  application.config.php          Module list for the application
  modules.config.php              Enabled module namespaces (e.g. 'Application')
module/
  Application/
    config/
      module.config.php           Route table + view-manager settings
    src/
      Module.php                  Application\Module — extends AbstractModule, returns config
      Controller/
        IndexController.php       Application\Controller\IndexController — indexAction()
    view/
      application/
        index/
          index.phtml             Default index view template
      error/
        404.phtml                 404 error page
      layout/
        layout.phtml              Master layout template
public/
  index.php                       Front controller (entry point)
  .htaccess                       Apache rewrite rules
  asset/                          Static assets (CSS, JS, images)
test/
  Application/
    ModuleTest.php                Covers Module::VERSION and getConfig()
    Controller/
      IndexControllerTest.php     Covers IndexController::indexAction()
    Fixture/
      ApplicationDouble.php       Test double for ApplicationInterface
data/
  cache/                          Cache directory (writable at runtime)
```

Source namespace: `Application\` → `module/Application/src/`
Test  namespace: `Application\Test\` → `test/Application/`

## Coding standards

- **Language:** PHP `^8.5`. Every PHP file starts with `declare(strict_types=1);`.
- **Autoloading:** PSR-4. `Application\` → `module/Application/src/`,
  `Application\Test\` → `test/Application/`. One class/interface per file; the file name
  matches the type name.
- **Naming:** controllers are suffixed `Controller` (`IndexController`); test doubles
  are suffixed `Double` and live under `test/Application/Fixture/`.
- **Module class stays minimal.** `Module` extends `AbstractModule` and only overrides
  `getConfig()` to return the module configuration. Do not add production logic here.
- **Controllers extend `AbstractController`.** Action methods return a `ViewModel`.
  Avoid embedding business logic in controllers — delegate to models/services.
- **Errors:** throw exceptions from the underlying component packages (e.g.
  `JiNexus\Mvc\MvcException`, `JiNexus\Route\RouteException`).
- **PHP 8.5 features are in use.** The test suite uses newer syntax (e.g., property
  hooks, pipe operator `|>`). Keep the `php: "^8.5"` constraint in mind — do not add
  code that requires a version higher than the declared floor, and do not lower the
  floor to accommodate a tool that doesn't understand 8.5.

### Test conventions

- Tests extend `PHPUnit\Framework\TestCase` and are declared `final`.
- Use PHPUnit **attributes**, not annotations: `#[Test]`, `#[CoversClass(...)]`.
- Test method names are `snake_case` and describe the behavior.
- PHPUnit 13: use `expectExceptionMessageMatches()` (regex), **not** the deprecated
  `expectExceptionMessage()`. Wrap literal text with `preg_quote($text, '/')`.
- **Prefer assertions that reflect a real runtime contract over ones the type checker can
  fold to a constant.** Assert on `class_implements(...)` / `class_parents(...)` instead
  of `assertInstanceOf` against an already-typed value.
- Test doubles for `ApplicationInterface` live in `test/Application/Fixture/`.
  Wire up real component instances (Config, Http, Route, ModuleManager) rather than
  stubbing every method — this keeps the test honest and catches integration issues.
- When a test deliberately exercises magic access or calls an unsupported magic method,
  suppress the specific IDE inspection on that line only
  (`//noinspection PhpUndefinedFieldInspection` / `PhpUndefinedMethodInspection`) with a
  comment saying why.
- **No data providers.** Group related cases as several assertions inside one themed
  test method instead.

## Workflow rules

- **Before finishing any change, run the suite** and make sure it's green:
  `XDEBUG_MODE=off ./vendor/bin/phpunit`. Then check coverage is still 100%:
  `composer test:coverage`.
- **After touching classes/namespaces**, run `composer dump-autoload`.
- **New behavior requires a new test.** Cover every branch you add or change. Maintain
  100% line/class/method coverage of the `module/Application/src/` source.
- **Commits:** follow [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/).
  Format: `type(scope): description`, with an optional body and footers.
  - Common types: `feat`, `fix`, `docs`, `test`, `refactor`, `chore`, `build`, `ci`.
  - Scope is optional and names the affected area (e.g. `feat(controller): …`).
  - Subject is imperative and lowercase, no trailing period.
  - Breaking changes: add `!` after the type/scope (`feat!:`) and a `BREAKING CHANGE:`
    footer describing the break and its migration.
- **Changelog:** update `CHANGELOG.md` for every user-visible change, following the Keep a
  Changelog structure already in the file (Added / Changed / Deprecated / Removed / Fixed).
  Newest release on top.
- **Versioning:** semantic versioning. When bumping the minor/major line, also update
  `extra.branch-alias.dev-main` in `composer.json` to match the next dev series.
- **Config files:** `phpunit.dist.xml` is the committed default; a local `phpunit.xml`
  (gitignored) overrides it for personal tweaks. Don't commit `phpunit.xml`, `vendor/`,
  or `.phpunit.cache/`.
- **Development server:** Use `composer run --timeout=0 serve` or
  `php -S localhost:8000 -t public`. The `public/` directory is the document root.
