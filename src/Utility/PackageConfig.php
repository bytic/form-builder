<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\FormBuilderServiceProvider;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig
 * @package ByTIC\FormBuilder\Utility
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;

    protected $name = FormBuilderServiceProvider::NAME;
}