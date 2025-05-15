<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Custom;


use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\IsUnique\IsUniqueTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\Mandatory\IsDefaultMandatoryTrait;

class Recaptcha extends AbstractType
{
    use AbstractTypeInterfaceTrait;
    use IsUniqueTrait;
    use IsDefaultMandatoryTrait;

    public function __construct()
    {
        parent::__construct();
        $this->setInputType('recaptcha');
    }

    /**
     * @return string
     */
    protected function getDefaultIcon(): string
    {
        return FieldIcons::SHIELD;
    }

    public function generateFormName(): string
    {
        return \Nip_Form_Element_Recaptcha::FORM_NAME;
    }

    public function saveToModel($form)
    {
        return;
    }
}