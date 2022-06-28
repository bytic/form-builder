<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields;

use ByTIC\Common\Records\Record;
use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;

/**
 * Class FormField.
 */
class FormField extends Record
{
    use FormFieldTrait;
    use \ByTIC\Common\Records\Traits\HasSerializedOptions\RecordTrait;

    public function getManager()
    {
        return FormFields::instance();
    }
}
