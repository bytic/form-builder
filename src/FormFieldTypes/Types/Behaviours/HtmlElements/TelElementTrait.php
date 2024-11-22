<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasHtmlLabel;

/**
 * Trait TextElementTrait.
 */
trait TelElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasHtmlLabel;

    public function __construct()
    {
        $this->setInputType('tel');
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
        return FieldIcons::TEXT_FIELD;
    }
}
