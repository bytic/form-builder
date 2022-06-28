<?php

namespace ByTIC\FormBuilder\Models\FormsFields;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class FormsFields.
 */
class FormsFields extends RecordManager
{
    use SingletonTrait;
    use FormFieldsTrait;

    public const TABLE = 'formbuilder-fields';
}
