<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;


/**
 * Trait TextareaElementTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements
 */
trait TextareaElementTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('textarea');
    }
}
