<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasHtmlLabel;

/**
 * Trait TextElementTrait.
 */
trait EmailElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasHtmlLabel;

    /**
     * @inheritdoc
     */
    public function processValidation($form)
    {
        $input = $form->getElement($this->getFormName());

        if ($input->isError()) {
            return;
        }
        $value = $input->getValue();
        if (!valid_email($value)) {
            $input->addError(translator()->trans('email.invalid'));
        }
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritdoc
     */
    public function getDefaultLabel()
    {
        return translator()->trans('email');
    }
}
