<?php

use Nip\Container\Container;

Container::setInstance(new Container());

app()->singleton('inflector', new Nip\Inflector\Inflector());
app()->singleton('app', new \Nip\Application\Application());
app()->singleton('translator', new \Nip\I18n\Translator());

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'fixtures');

require dirname(__DIR__) . '/vendor/autoload.php';
