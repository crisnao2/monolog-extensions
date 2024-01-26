[![Latest Stable Version](https://img.shields.io/packagist/v/crisnao2/monolog-extensions.svg?style=flat-square)](https://packagist.org/packages/crisnao2/monolog-extensions)
![PHP from Packagist](https://img.shields.io/packagist/php-v/crisnao2/monolog-extensions?style=flat-square)
![Licence](https://img.shields.io/packagist/l/crisnao2/monolog-extensions?style=flat-square)

# Datadog Monolog integration

This project aims to be a set of extensions to complement the monolog

## Requirements

- Php 7.1+
- Monolog

## Features

- Complement log with backtrace

## Installation

Install the latest version with

```
composer require crisnao2/monolog-extensions
```


### Basic Usage

```php showLineNumbers
<?php

use Monolog\Logger;
use MonologExtensions\Processor\BacktraceProcessor;

$monolog = new Logger('backtrace');

$monolog->pushProcessor(new BacktraceProcessor(3));

$monolog->info('i am an info');
$monolog->warning('i am a warning..');
$monolog->error('i am an error ');
$monolog->notice('i am a notice');
$monolog->emergency('i am an emergency');
```

##### Output
```
[2024-01-26T19:47:57.531159-03:00] backtrace.log.INFO: i am an info [] {"backtrace":[{"function":"error","file":"/home/www-data/info.php","line":10},{"function":"index","file":"file not defined","line":"line not defined"},{"function":"call_user_func_array","file":"vendor/php-di/invoker/src/Invoker.php","line":74},{"function":"call","file":"vendor/php-di/slim-bridge/src/ControllerInvoker.php","line":47}]}
[2024-01-26T19:47:57.531159-03:00] backtrace.log.WARNING: i am an info [] {"backtrace":[{"function":"error","file":"/home/www-data/info.php","line":11},{"function":"index","file":"file not defined","line":"line not defined"},{"function":"call_user_func_array","file":"vendor/php-di/invoker/src/Invoker.php","line":74},{"function":"call","file":"vendor/php-di/slim-bridge/src/ControllerInvoker.php","line":47}]}
[2024-01-26T19:47:57.531159-03:00] backtrace.log.ERROR: i am an info [] {"backtrace":[{"function":"error","file":"/home/www-data/info.php","line":12},{"function":"index","file":"file not defined","line":"line not defined"},{"function":"call_user_func_array","file":"vendor/php-di/invoker/src/Invoker.php","line":74},{"function":"call","file":"vendor/php-di/slim-bridge/src/ControllerInvoker.php","line":47}]}
[2024-01-26T19:47:57.531159-03:00] backtrace.log.NOTICE: i am an info [] {"backtrace":[{"function":"error","file":"/home/www-data/info.php","line":13},{"function":"index","file":"file not defined","line":"line not defined"},{"function":"call_user_func_array","file":"vendor/php-di/invoker/src/Invoker.php","line":74},{"function":"call","file":"vendor/php-di/slim-bridge/src/ControllerInvoker.php","line":47}]}
[2024-01-26T19:47:57.531159-03:00] backtrace.log.EMERGENCY: i am an info [] {"backtrace":[{"function":"error","file":"/home/www-data/info.php","line":14},{"function":"index","file":"file not defined","line":"line not defined"},{"function":"call_user_func_array","file":"vendor/php-di/invoker/src/Invoker.php","line":74},{"function":"call","file":"vendor/php-di/slim-bridge/src/ControllerInvoker.php","line":47}]}
```