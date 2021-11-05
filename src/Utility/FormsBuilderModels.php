<?php

namespace ByTIC\FormBuilder\Utility;

use ByTIC\FormBuilder\FormBuilderServiceProvider;
use ByTIC\FormBuilder\Models\Fields\Fields;
use ByTIC\FormBuilder\Models\Forms\Forms;
use ByTIC\FormBuilder\Models\Values\Values;
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
     * @return RecordManager|Fields
     */
    public static function fields()
    {
        return static::getModels('fields', Fields::class);
    }

    /**
     * @return RecordManager|Values
     */
    public static function values()
    {
        return static::getModels('values', Values::class);
    }

    protected static function packageName(): string
    {
        return FormBuilderServiceProvider::NAME;
    }
}
