<?php

namespace ByTIC\FormBuilder\FormResponseValues\Models;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;
use Nip\Records\Record;

/**
 * Class Form.
 */
class FormResponseValue extends Record
{
    use HasFormsRecordTrait;
    use FormResponseValueTrait;
}
