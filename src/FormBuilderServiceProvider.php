<?php

namespace ByTIC\FormBuilder;

use ByTIC\PackageBase\BaseBootableServiceProvider;

/**
 * Class FormBuilderServiceProvider.
 */
class FormBuilderServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'form-builder';

    public function register()
    {
        $this->registerResources();
    }

    public function migrations(): string
    {
        return dirname(__DIR__).'/migrations/';
    }

    protected function registerResources()
    {
        if (false === $this->getContainer()->has('translator')) {
            return;
        }
        $translator = $this->getContainer()->get('translator');
        $folder = dirname(__DIR__).'/resources/lang/';
        $languages = $this->getContainer()->get('translation.languages');


        foreach ($languages as $language) {
            $path = $folder.$language;
            if (is_dir($path)) {
                $translator->addResource('php', $path, $language);
            }
        }
    }

}
