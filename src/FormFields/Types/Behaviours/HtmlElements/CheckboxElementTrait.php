<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFields\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFields\Types\Behaviours\HasHtmlLabel;

/**
 * Trait CheckboxElementTrait.
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
     *
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
     *
     * @return string
     */
    public function printItemValue($model)
    {
        $value = parent::printItemValue($model);

        if ($value) {
            $value = 'YES';
        } else {
            $value = '--';
        }

        return $value;
    }
}
