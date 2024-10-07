<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasHtmlLabel;

/**
 * Trait TextareaElementTrait.
 */
trait TextareaElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasHtmlLabel;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('textarea');
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
        return FieldIcons::TEXTAREA;
    }
}
