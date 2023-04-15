<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields;

use Nip\Records\RecordManager;

/**
 * Class FormsFields.
 */
class FormsFields extends RecordManager
{
    use FormFieldsTrait;

    public const TABLE = 'formbuilder-fields';
}
