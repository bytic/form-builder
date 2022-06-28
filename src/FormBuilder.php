<?php

namespace ByTIC\FormBuilder;

use ByTIC\FormBuilder\Application\Library\View\View;

/**
 * Class FormBuilder.
 */
class FormBuilder
{
    /**
     * @param $path
     *
     * @return string|null
     */
    public static function loadAssetContent($path)
    {
        $fullPath = self::basePath()
            .DIRECTORY_SEPARATOR.'resources'
            .DIRECTORY_SEPARATOR.'assets'
            .$path;
        if (file_exists($fullPath)) {
            return file_get_contents($fullPath);
        }

        return '';
    }

    /**
     * @return string
     */
    public static function basePath()
    {
        return dirname(__DIR__);
    }

    /**
     * @param $path
     * @param array $variables
     *
     * @return string|null
     */
    public static function loadView($path, $variables = [])
    {
        return View::instance()->load($path, $variables, true);
    }
}
