<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Custom;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements\RadioGroupElementTrait;

/**
 * Class CustomCheckboxGroup
 * @package KM42\Register\Models\Races\FormFields\Types
 */
class RadioGroup extends AbstractType
{
    use RadioGroupElementTrait;

    protected $aliases = ['custom_radio_group'];
}
