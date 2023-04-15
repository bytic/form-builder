<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Dto;

use ByTIC\DataObjects\Behaviors\Serializable\SerializableTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use Serializable;

class FormFieldsList implements Serializable
{
    use SerializableTrait;

    protected $serializable = ['classmap', 'all'];

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