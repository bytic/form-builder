<?php

namespace ByTIC\FormBuilder;

use ByTIC\PackageBase\BaseBootableServiceProvider;

/**
 * Class FormBuilderServiceProvider.
 */
class FormBuilderServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'form-builder';

    public function migrations(): string
    {
        return dirname(__DIR__).'/migrations/';
    }

    protected function translationsPath(): string
    {
        return dirname(__DIR__).'/resources/lang/';
    }
}
