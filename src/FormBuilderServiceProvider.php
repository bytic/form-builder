<?php

namespace ByTIC\FormBuilder;

use ByTIC\PackageBase\BaseBootableServiceProvider;

class FormBuilderServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'form-builder';

    public function migrations(): string
    {
        return dirname(__DIR__) . '/migrations/';
    }
}