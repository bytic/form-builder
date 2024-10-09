<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Custom;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements\CheckboxGroupElementTrait;

/**
 * Class CustomCheckboxGroup
 * @package KM42\Register\Models\Races\FormFields\Types
 */
class CheckboxGroup extends AbstractType
{
    use CheckboxGroupElementTrait;

    protected $aliases = ['custom_checkbox_group'];
}
