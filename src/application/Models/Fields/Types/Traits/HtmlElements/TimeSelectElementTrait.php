<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;

/**
 * Trait TimeSelectElementTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements
 */
trait TimeSelectElementTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setInputType('timeselect');
    }

}