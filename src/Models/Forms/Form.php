<?php

namespace ByTIC\FormBuilder\Models\Forms;

use Nip\Records\Record;

/**
 * Class Form.
 */
class Form extends Record
{
    use \ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;
    use FormTrait;
}
