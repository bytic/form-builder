<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasHtmlLabel;

/**
 * Trait TextElementTrait.
 */
trait TextElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasHtmlLabel;

    /**
     * {@inheritDoc}
     */
    public function initFormInput($input)
    {
        $this->htmlDecodeLabel($input);

        return parent::initFormInput($input);
    }
}
