<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\FormBuilderServiceProvider;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig.
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;

    protected $name = FormBuilderServiceProvider::NAME;
}
