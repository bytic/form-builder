<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\Controllers\Admin\PageControllerFormBuilderViewPathsTrait;
use Nip\View\View;

/**
 * Class ViewHelper.
 */
class ViewHelper
{
    /**
     * @param View|PageControllerFormBuilderViewPathsTrait $view
     */
    public static function registerAdminPaths(View $view)
    {
        $view->addPath(PathsHelpers::views('/admin/'), 'FormBuilder');
        $view->addPath(PathsHelpers::views('/admin/'));
    }
}
