<?php

namespace ByTIC\FormBuilder\FormResponseValues\Models;

use ByTIC\FormBuilder\Base\Models\Record;
use ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;

/**
 * Class Form.
 */
class FormResponseValue extends Record
{
    use HasFormsRecordTrait;
    use FormResponseValueTrait;
}
