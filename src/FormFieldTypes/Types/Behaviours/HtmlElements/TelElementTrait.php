<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasHtmlLabel;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasIcon\HasPhoneIconTrait;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

/**
 * Trait TextElementTrait.
 */
trait TelElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasHtmlLabel;
    use HasPhoneIconTrait;

    public function __construct()
    {
        parent::__construct();
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

    public function processValidation($form)
    {
        parent::processValidation($form);
        $input = $form->getElement($this->getFormName());

        if ($input->isError()) {
            return;
        }
        $value = $input->getValue();
        if (empty($value) && !$input->isRequired()) {
            return;
        }
        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        $errorMessage = $this->getErrorMessageInvalid();
        try {
            $phoneNumber = $phoneNumberUtil->parse($value, 'RO');
            if ($phoneNumberUtil->isValidNumber($phoneNumber)) {
                $input->setValue($phoneNumberUtil->format($phoneNumber, PhoneNumberFormat::E164));
            } else {
                $input->addError($errorMessage, 'invalid');
            }
        } catch (NumberParseException $e) {
            $input->addError($errorMessage, 'invalid');
        }
    }

    protected function getErrorMessageInvalid()
    {
        return translator()->trans('tel.invalid');
    }
}
