<?php

namespace ByTIC\FormBuilder\Models\FieldsValues;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class FieldsValues.
 */
class FieldsValues extends RecordManager
{
    use SingletonTrait;
    use \ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
    use \ByTIC\Records\Behaviors\I18n\I18nRecordsTrait;

    public const TABLE = 'formbuilder-values';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }
}
