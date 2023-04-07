<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFields\Types\Behaviours\AbstractTypeInterfaceTrait;

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
