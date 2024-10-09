<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Custom;


use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements\CheckboxElementTrait;

/**
 * Class CustomCheckbox
 */
class Checkbox extends AbstractType
{
    use CheckboxElementTrait;

    protected $aliases = ['custom_checkbox'];
}