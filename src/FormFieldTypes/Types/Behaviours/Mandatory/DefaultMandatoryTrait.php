<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\Mandatory;

trait DefaultMandatoryTrait
{

    /**
     * @return string
     */
    public function getDefaultMandatory(): string
    {
        return 'no';
    }
}