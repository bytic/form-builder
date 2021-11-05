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
    use ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
    use \ByTIC\Records\Behaviors\I18n\I18nRecordsTrait;

    public const TABLE = 'formbuilder-fields';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }
}
