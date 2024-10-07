<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Custom;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\CustomElements\AbstractCustomElementTrait;

/**
 *
 */
abstract class AbstractType extends \ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType
{
    use AbstractCustomElementTrait;

    public const CUSTOM_TYPES = [
        Checkbox::class,
        CheckboxGroup::class,
        RadioGroup::class,
        Select::class,
        Text::class,
        Textarea::class,
        Timeselect::class,
    ];
}
