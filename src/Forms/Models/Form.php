<?php

namespace ByTIC\FormBuilder\Forms\Models;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;
use Nip\Records\Record;

/**
 * Class Form.
 */
class Form extends Record
{
    use HasFormsRecordTrait;
    use FormTrait;
}
