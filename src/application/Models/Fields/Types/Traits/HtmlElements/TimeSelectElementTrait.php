<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;

/**
 * Trait TimeSelectElementTrait.
 */
trait TimeSelectElementTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->setInputType('timeselect');
    }

    /**
     * {@inheritDoc}
     */
    public function initFormInput($input)
    {
        $this->htmlDecodeLabel($input);

        return parent::initFormInput($input);
    }
}
