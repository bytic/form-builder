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
    protected $role = [];

    /**
     * @param AbstractType $field
     * @return $this
     */
    public function add($field): self
    {
        $class = get_class($field);
        $this->classmap[$field->getName()] = $class;
        $this->all[$class] = $field;
        $this->role[$field->getRole()][$field->getName()] = $field;

        return $this;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function classForName($name)
    {
        return $this->classmap[$name] ?? null;
    }

    public function get($name): ?AbstractType
    {
        if (isset($this->all[$name])) {
            return $this->all[$name];
        }
        $class = $this->classForName($name);
        if ($class === null) {
            return null;
        }

        return $this->all[$class] ?? null;
    }

    public function all(): array
    {
        return $this->all;
    }

    public function count(): ?int
    {
        return count($this->all);
    }
}