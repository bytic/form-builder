<?php

use Nip\Container\Container;

Container::setInstance(new Container());

app()->share('inflector', new Nip\Inflector\Inflector());
app()->share('app', new \Nip\Application\Application());
app()->share('translator', new \Nip\I18n\Translator('en'));

define('PROJECT_BASE_PATH', __DIR__.'/..');
define('TEST_BASE_PATH', __DIR__);
define('CURRENT_URL', '');
define('TEST_FIXTURE_PATH', __DIR__.DIRECTORY_SEPARATOR.'fixtures');

require dirname(__DIR__).'/vendor/autoload.php';
