<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasIcon;

use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;

trait HasGenderIconTrait
{

    protected function getDefaultIcon(): string
    {
        return FieldIcons::GENDER;
    }
}