<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeTrait;
use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordsTrait as HasTypesTrait;

/**
 * Trait FormFieldsTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits
 *
 * @method FormFieldTrait getNew($data = [])
 */
trait FormFieldsTrait
{
    use HasTypesTrait;

    /**
     * @var null|array
     */
    protected $typesMatrix = null;

    /**
     * @param string $role
     * @return AbstractTypeTrait[]|null
     */
    public function getTypesByRole($role)
    {
        $this->checkInitTypesMatrix();
        return isset($this->typesMatrix[$role]) ? $this->typesMatrix[$role] : null;
    }

    /**
     * @return array
     */
    protected function getTypesMatrix()
    {
        $this->checkInitTypesMatrix();
        return $this->typesMatrix;
    }

    protected function checkInitTypesMatrix()
    {
        if ($this->typesMatrix === null) {
            $this->generateTypesMatrix();
        }
    }

    protected function generateTypesMatrix()
    {
        $items = $this->getSmartPropertyDefinition('Type')->getItems();
        foreach ($items as $item) {
            $this->typesMatrix[$item->getRole()][$item->getName()] = $item;
        }
    }

//    /**
//     * @param AbstractTypeTrait $object
//     */
//    public function addType($object)
//    {
//        /** @noinspection PhpParamsInspection */
//        $this->addTypeTrait($object);
//        $this->typesMatrix[$object->getRole()][$object->getName()] = $object;
//    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return [];
    }
}
