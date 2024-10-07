<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasIcon;

use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;

trait HasCountryIconTrait
{

    protected function getDefaultIcon(): string
    {
        return FieldIcons::PHONE;
    }
}