<?php

namespace ByTIC\FormBuilder\Forms\Models;

use ByTIC\FormBuilder\Base\Models\Record;
use ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;

/**
 * Class Form.
 */
class Form extends Record
{
    use HasFormsRecordTrait;
    use FormTrait;
}
