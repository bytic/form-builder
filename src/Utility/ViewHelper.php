<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\Controllers\Admin\HasAdminViewPathsTrait;
use Nip\View\View;

/**
 * Class ViewHelper
 * @package ByTIC\FormBuilder\Utility
 */
class ViewHelper
{
    /**
     * @param View|HasAdminViewPathsTrait $view
     */
    public static function registerAdminPaths(View $view)
    {
        $view->addPath(PathsHelpers::views('/admin/'), 'FormBuilder');
        $view->addPath(PathsHelpers::views('/admin/'));
    }
}