<?php

define('PROJECT_BASE_PATH', __DIR__.'/..');
define('TEST_BASE_PATH', __DIR__);
define('CURRENT_URL', '');
define('TEST_FIXTURE_PATH', __DIR__.DIRECTORY_SEPARATOR.'fixtures');

use Nip\Application\Application;
use Nip\Cache\Stores\Repository;
use Nip\Container\Container;
use Nip\I18n\Translator;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

Container::setInstance(new Container());

app()->share('inflector', new Nip\Inflector\Inflector());
app()->share('app', new Application());
app()->share('translator', new Translator('en'));

$cachePath = TEST_FIXTURE_PATH.'/storage/cache';
array_map(function ($path) {
    if (is_file($path)) {
        unlink($path);
    }
}, glob($cachePath.'/@/*'));

$adapter = new FilesystemAdapter('', 600, $cachePath);
$store = new Repository($adapter);
$store->clear();
Container::getInstance()->set('cache.store', $store);

require dirname(__DIR__).'/vendor/autoload.php';
