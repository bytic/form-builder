<?php

namespace ByTIC\FormBuilder\Controllers\Admin;

use ByTIC\FormBuilder\Utility\ViewHelper;

/**
 * Trait HasAdminViewPathsTrait
 * @package ByTIC\AdminBase\Library\Controllers\Traits
 */
trait HasAdminViewPathsTrait
{
    protected function bootHasAdminViewPathsTrait()
    {
        $this->after(
            function () {
                $this->registerHelloViewPaths();
            }
        );
    }

    protected function registerHelloViewPaths()
    {
        $view = $this->getView();
        ViewHelper::registerAdminPaths($view);
    }
}
