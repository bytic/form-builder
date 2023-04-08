<?php

namespace ByTIC\FormBuilder\FormFields\Dto;

use ByTIC\FormBuilder\FormFields\Types\AbstractType;

class FormFieldsList
{
    protected $classmap = [];

    protected $all = [];

    /**
     * @param AbstractType $field
     * @return $this
     */
    public function add($field): self
    {
        $class = get_class($field);
        $this->classmap[$field->getName()] = $class;
        $this->all[$class] = $field;

        return $this;
    }

    public function all(): array
    {
        return $this->all;
    }
}