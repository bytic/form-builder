<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;

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

    protected function getDefaultIcon(): string
    {
        return FieldIcons::TIMEPICKER;
    }
}
