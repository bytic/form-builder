<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Traits;

use ByTIC\Common\Records\Traits\HasTypes\RecordsTrait as HasTypesTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeTrait;

/**
 * Trait FormFieldsTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits
 *
 * @method FormFieldTrait getNew($data = [])
 */
trait FormFieldsTrait
{
    use HasTypesTrait {
        HasTypesTrait::addType as addTypeTrait;
    }

    protected $typesMatrix = null;

    /**
     * @param string $role
     * @return AbstractTypeTrait[]|null
     */
    public function getTypesByRole($role)
    {
        $this->checkInitTypes();

        return isset($this->typesMatrix[$role]) ? $this->typesMatrix[$role] : null;
    }

    /**
     * @param AbstractTypeTrait $object
     */
    public function addType($object)
    {
        /** @noinspection PhpParamsInspection */
        $this->addTypeTrait($object);
        $this->typesMatrix[$object->getRole()][$object->getName()] = $object;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return [];
    }
}
