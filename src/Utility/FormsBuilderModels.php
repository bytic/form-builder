<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\FormBuilderServiceProvider;
use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsFields;
use ByTIC\FormBuilder\FormResponseValues\Models\FormResponseValues;
use ByTIC\FormBuilder\Forms\Models\Forms;
use ByTIC\PackageBase\Utility\ModelFinder;
use Nip\Records\RecordManager;

/**
 * Class NotifierBuilderModels.
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
        return static::getModels('values', FormResponseValues::class);
    }

    protected static function packageName(): string
    {
        return FormBuilderServiceProvider::NAME;
    }
}
