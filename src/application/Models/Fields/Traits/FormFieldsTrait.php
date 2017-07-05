<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Traits;

use ByTIC\Common\Records\Traits\HasTypes\RecordsTrait as HasTypesTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeTrait;

/**
 * Trait FormFieldsTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits
 *
 */
trait FormFieldsTrait
{
    use HasTypesTrait;

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
}