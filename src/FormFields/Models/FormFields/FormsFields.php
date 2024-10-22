<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields;

use ByTIC\FormBuilder\Base\Models\RecordManager;

/**
 * Class FormsFields.
 */
class FormsFields extends RecordManager
{
    use FormFieldsTrait;

    public const TABLE = 'formbuilder-fields';
}
