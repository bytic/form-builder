<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Custom;


use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\IsUnique\IsUniqueTrait;

class Recaptcha extends AbstractType
{
    use AbstractTypeInterfaceTrait;
    use IsUniqueTrait;

    public function __construct()
    {
        parent::__construct();
        $this->setInputType('recaptcha');
    }
}