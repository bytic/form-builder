<?php

namespace ByTIC\FormBuilder\Application\Models\ModelFields\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;

/**
 * Trait ModelWithFieldsRecordTrait
 * @package ByTIC\FormBuilder\Application\Models\ModelsWithFields\Traits
 *
 * @property int $id_field
 * @property string $value
 */
trait ModelFieldsRecordTrait
{
    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param FormFieldTrait $field
     * @return $this
     */
    public function populateFromField($field)
    {
        $this->id_field = $field->id;
        return $this;
    }
}
