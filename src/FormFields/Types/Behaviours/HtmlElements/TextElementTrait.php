<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFields\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFields\Types\Behaviours\HasHtmlLabel;

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
