<?php

namespace ByTIC\FormBuilder\Models\FormsFields;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class FormsFields
 * @package ByTIC\FormBuilder\Models\FormsFields
 */
class FormsFields extends RecordManager
{
    use SingletonTrait;

    public const TABLE = 'formbuilder-fields';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }
}
