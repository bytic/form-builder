<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasIcon;

use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;

trait HasCalendarIconTrait
{

    protected function getDefaultIcon(): string
    {
        return FieldIcons::CALENDAR;
    }
}