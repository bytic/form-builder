<?php

namespace ByTIC\FormBuilder\FormFields\Dto;

use ByTIC\FormBuilder\FormFields\Types\AbstractType;

class FormFieldsDesigner
{
    protected $existing = [];

    protected FormFieldsList $available;

    protected $custom = [];

    /**
     * @param $role
     * @return array|mixed
     */
    public function getExisting($role)
    {
        return $this->existing[$role] ?? [];
    }

    public function addAvailable(AbstractType $field): self
    {
        $role = $field->getRole();
        $this->available[$role][] = $field;
        return $this;
    }
}