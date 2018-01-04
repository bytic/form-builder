<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields;

use ByTIC\Common\Records\Record;
use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeTrait;

/**
 * Class FormField
 * @package ByTIC\FormBuilder\Tests\Fixtures\Application\Modules\AbstractModule\Forms
 */
class FormField extends Record
{
    use FormFieldTrait;
    use \ByTIC\Common\Records\Traits\HasSerializedOptions\RecordTrait;

    /**
     * @return AbstractTypeTrait
     */
    public function getType()
    {
        return 'text';
    }
}
