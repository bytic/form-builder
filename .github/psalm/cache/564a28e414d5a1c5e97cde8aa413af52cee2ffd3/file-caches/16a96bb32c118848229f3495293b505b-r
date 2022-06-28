<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\FormBuilderServiceProvider;
use ByTIC\FormBuilder\Models\FieldsValues\FieldsValues;
use ByTIC\FormBuilder\Models\Forms\Forms;
use ByTIC\FormBuilder\Models\FormsFields\FormsFields;
use ByTIC\PackageBase\Utility\ModelFinder;
use Nip\Records\RecordManager;

/**
 * Class NotifierBuilderModels
 * @package ByTIC\FormBuilder\Utility
 */
class FormsBuilderModels extends ModelFinder
{
    /**
     * @return RecordManager|Forms
     */
    public static function forms()
    {
        return static::getModels('forms', Forms::class);
    }

    /**
     * @return RecordManager|FormsFields
     */
    public static function fields()
    {
        return static::getModels('fields', FormsFields::class);
    }

    /**
     * @return RecordManager|FieldsValues
     */
    public static function values()
    {
        return static::getModels('values', FieldsValues::class);
    }

    protected static function packageName(): string
    {
        return FormBuilderServiceProvider::NAME;
    }
}
