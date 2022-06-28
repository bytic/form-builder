<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\Behaviours\HasHtmlLabel;

/**
 * Trait CheckboxElementTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements
 */
trait CheckboxElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasHtmlLabel;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('checkbox');
    }

    /**
     * @param \Nip_Form_Element_Input_Abstract $input
     * @return mixed
     */
    public function initFormInput($input)
    {
        parent::initFormInput($input);

        $input->setOption('render_label', false);
        $this->htmlDecodeLabel($input);

        return $input;
    }

    /**
     * @param $model
     * @return string
     */
    public function printItemValue($model)
    {
        $value = parent::printItemValue($model);

        if ($value) {
            $value = "YES";
        } else {
            $value = '--';
        }
        return $value;
    }
}
