<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\Mandatory;

trait IsDefaultMandatoryTrait
{

    /**
     * @return string
     */
    public function getDefaultMandatory(): string
    {
        return 'yes';
    }
}