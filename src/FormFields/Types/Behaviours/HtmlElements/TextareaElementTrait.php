<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFields\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFields\Types\Behaviours\HasHtmlLabel;

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
}
