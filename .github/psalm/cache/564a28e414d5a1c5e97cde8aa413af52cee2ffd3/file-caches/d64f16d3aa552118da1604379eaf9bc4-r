<?php

namespace ByTIC\FormBuilder\Utility;

/**
 * Class PathsHelpers
 * @package ByTIC\FormBuilder\Utility
 */
class PathsHelpers
{
    /**
     * @param $path
     * @param $theme
     * @return string
     */
    public static function views($path)
    {
        return static::basePath() . '/resources/views' . $path;
    }

    /**
     * @return string
     */
    public static function basePath(): string
    {
        return dirname(dirname(__DIR__));
    }
}