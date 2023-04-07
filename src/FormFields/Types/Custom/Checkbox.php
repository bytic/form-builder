<?php

namespace ByTIC\FormBuilder\FormFields\Types\Custom;


/**
 * Class CustomCheckbox
 */
class Checkbox extends AbstractType
{

    protected $inputType = 'checkbox';

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