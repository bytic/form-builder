<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\CustomElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;

/**
 * Trait AbstractCustomElementTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits
 */
trait AbstractCustomElementTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * @inheritdoc
     */
    public function getFormName()
    {
        return $this->getName() . '-' . sha1($this->getItem()->id);
    }
}