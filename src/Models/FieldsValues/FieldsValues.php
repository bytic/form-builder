<?php

namespace ByTIC\FormBuilder\Models\FieldsValues;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class FieldsValues
 * @package ByTIC\FormBuilder\Models\FieldsValues
 */
class FieldsValues extends RecordManager
{
    use SingletonTrait;

    public const TABLE = 'formbuilder-values';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }
}
