<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;

/**
 * Trait CheckboxElementTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements
 */
trait CheckboxElementTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('checkbox');
    }

    /**
     * @param $input
     * @return mixed
     */
    public function initFormInput($input)
    {
        parent::initFormInput($input);

        $input->setOption('render_label', false);
        $label = $input->getLabel();
        $label = html_entity_decode($label);
        $title = strip_tags($label);

        $input->setAttrib('title', $title);
        $input->setLabel($label);

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
