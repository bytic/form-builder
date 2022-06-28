<?php

namespace ByTIC\FormBuilder\Utility;

/**
 * Class PathsHelpers.
 */
class PathsHelpers
{
    /**
     * @param $path
     * @param $theme
     *
     * @return string
     */
    public static function views($path)
    {
        return static::basePath().'/resources/views'.$path;
    }

    public static function basePath(): string
    {
        return dirname(dirname(__DIR__));
    }
}
