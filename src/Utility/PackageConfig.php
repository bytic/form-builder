<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\FormBuilderServiceProvider;
use Exception;
use Nip\Config\Config;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig.
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;

    protected $name = FormBuilderServiceProvider::NAME;

    public static function modelsForms($default = null)
    {
        return self::instance()->get('models.forms', $default);
    }

    /**
     * @param $default
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function tablesForms($default = null)
    {
        return self::instance()->get('tables.forms', $default);
    }

    /**
     * @param $default
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function tablesFields($default = null)
    {
        return self::instance()->get('tables.fields', $default);
    }

    /**
     * @param $default
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function tablesValues($default = null)
    {
        return self::instance()->get('tables.values', $default);
    }

    /**
     * @param $default
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function consumers($default = [])
    {
        return self::instance()->get('consumers', $default);
    }
}
