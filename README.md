# JiNexus Framework Skeleton

The official skeleton application for the **JiNexus Framework**. Use it as a starting
point to build MVC applications with the JiNexus component stack (mvc, http, route,
config, module-manager).

- Documentation: https://framework.jinexus.com/documentation
- Issues: https://github.com/jinexus-framework/jinexus-framework-skeleton/issues

## Requirements

- PHP `^8.5`
- [Composer](https://getcomposer.org/)
- Apache `mod_rewrite` (or equivalent for your web server)
- PHP `mbstring` extension

## Installation

Create a new project with Composer:

```bash
composer create-project jinexus-framework/jinexus-framework-skeleton path/to/my-project
```

This downloads the skeleton and its dependencies, generates the directory layout, and
configures autoloading — your application is ready to run.

### Directory permissions

Make the cache directory writable by the web server:

```bash
chown -R www-data:www-data path/to/my-project/data/cache
chmod -R g+rwX path/to/my-project/data/cache
```

## Quick start

Start the built-in PHP development server from the project root:

```bash
# Via Composer (recommended)
composer run --timeout=0 serve

# Or directly with PHP
php -S localhost:8000 -t public
```

Browse to [http://localhost:8000](http://localhost:8000). You should see the default
application page.

## Directory layout

```
config/
  application.config.php      Module list for the application
  modules.config.php          Enabled module namespaces
module/
  Application/
    config/
      module.config.php       Route and view-manager configuration
    src/
      Module.php              Application module class
      Controller/
        IndexController.php   Default controller
    view/
      application/index/      View templates
      error/                  Error page templates
      layout/                 Layout templates
public/
  index.php                   Front controller (document root)
  .htaccess                   Apache rewrite rules
  asset/                      Static assets
test/
  Application/                Unit tests mirroring the module structure
data/
  cache/                      Cache directory (must be writable)
```

## Extending

### Adding a new module

1. Create a namespace directory under `module/`, e.g. `module/Blog/src/`.
2. Add a `Module` class extending `JiNexus\ModuleManager\ModuleManager\AbstractModule`
   that returns its config from `getConfig()`.
3. Register the namespace in `config/modules.config.php`.
4. Add any routes, controllers, and view templates following the `Application` module
   pattern.

### Adding a controller

Create a class under `module/<Name>/src/Controller/` extending
`JiNexus\Mvc\Controller\AbstractController`. Action methods return a `ViewModel`:

```php
namespace Application\Controller;

use JiNexus\Mvc\Controller\AbstractController;
use JiNexus\Mvc\Model\ViewModel;

class IndexController extends AbstractController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel([
            'helloWorld' => 'Hello World!',
        ]);
    }
}
```

Register the route in the module's `module.config.php`.

## Testing

```bash
composer test              # or: ./vendor/bin/phpunit
composer test:coverage     # text coverage report
```

The suite is configured via `phpunit.dist.xml`. Use `XDEBUG_MODE=off` to silence the
local Xdebug notice, and `--testdox` for readable per-test output:

```bash
XDEBUG_MODE=off ./vendor/bin/phpunit --testdox
```

Tests are under `test/Application/` mirroring the `module/Application/src/` structure.
The source ships at **100% line, method, and class coverage**.

## Contributing

Please see [CONDUCT.md](CONDUCT.md) for the code of conduct. Contributions should include
tests and a `CHANGELOG.md` entry. See [AGENTS.md](AGENTS.md) for detailed build, style,
and workflow conventions.

## License

BSD-3-Clause. See [LICENSE.md](LICENSE.md).
