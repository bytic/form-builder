<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\Consumers\Dto\ConsumersList;
use ByTIC\FormBuilder\FormBuilderServiceProvider;
use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsFields;
use ByTIC\FormBuilder\Forms\Models\Forms;
use ByTIC\FormBuilder\Models\FieldsValues\FieldsValues;
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
     * @param string $default
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function tablesForms(string $default = Forms::TABLE): string
    {
        return self::instance()->get('tables.forms', $default);
    }

    /**
     * @param string $default
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function tablesFields(string $default = FormsFields::TABLE): string
    {
        return self::instance()->get('tables.fields', $default);
    }

    /**
     * @param string $default
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function tablesValues(string $default = FieldsValues::TABLE): string
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

    /**
     * @param $default
     * @return mixed|Config|string|null
     * @throws Exception
     */
    public static function consumersList($default = []): ConsumersList
    {
        $self = self::instance();
        if (isset($self->cache['consumersList'])) {
            return $self->cache['consumersList'];
        }
        $consumerConfig = ConsumersList::staticFromConfig(self::consumers());
        $self->cache['consumersList'] = $consumerConfig;

        return $consumerConfig;
    }
}
