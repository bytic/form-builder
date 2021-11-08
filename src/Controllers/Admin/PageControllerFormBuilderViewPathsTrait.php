<?php

namespace ByTIC\FormBuilder\Controllers\Admin;

use ByTIC\FormBuilder\Utility\ViewHelper;

/**
 * Trait HasAdminViewPathsTrait
 * @package ByTIC\AdminBase\Library\Controllers\Traits
 */
trait PageControllerFormBuilderViewPathsTrait
{
    protected function bootPageControllerFormBuilderViewPathsTrait()
    {
        $this->after(
            function () {
                $this->registerFormBuilderViewPaths();
            }
        );
    }

    protected function registerFormBuilderViewPaths()
    {
        $view = $this->getView();
        ViewHelper::registerAdminPaths($view);
    }
}
