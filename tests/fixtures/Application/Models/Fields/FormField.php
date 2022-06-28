<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use Nip\Records\Record;
use Nip\Records\RecordManager;

/**
 * Class FormField.
 */
class FormField extends Record
{
    use FormFieldTrait;

    /**
     * @return RecordManager
     */
    public function getManager()
    {
        return FormFields::instance();
    }

    public function getRegistry()
    {
        // TODO: Implement getRegistry() method.
    }
}
