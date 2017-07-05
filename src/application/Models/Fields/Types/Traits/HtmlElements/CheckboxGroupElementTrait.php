<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;
use Nip_Form_Model as NipModelForm;

/**
 * Trait CheckboxGroupElementTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements
 */
trait CheckboxGroupElementTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('checkboxGroup');
    }

    /**
     * @param $input
     * @return mixed
     */
    public function initFormInput($input)
    {
        $values = $this->getItem()->setOption('check_options');
        foreach ($values as $value) {
            $input->addOption($value, $value);
        }

        $input->getRenderer()->setSeparator('');

        return parent::initFormInput($input);
    }

    /**
     * @var $form NipModelForm
     */
    public function adminGetDataFromModel($form)
    {
        parent::adminGetDataFromModel($form);

        $form->addTextarea('check_options', translator()->translate('check_options'), true);
        $form->getElement('check_options')->setValue(
            implode("\n", $form->getModel()->getOption('check_options'))
        );
    }


    /**
     * @var $form NipModelForm
     */
    public function adminSaveToModel($form)
    {
        parent::adminSaveToModel($form);

        $values = $form->getElement('check_options')->getValue();
        $values = array_map('trim', explode("\n", $values));
        $form->getModel()->setOption('check_options', $values);
    }


    /**
     * @param $form
     * @param string $requester
     * @return string
     */
    public function getFormValue($form, $requester = 'model')
    {
        $formValue = $form->getElement($this->getFormName())->getValue($requester);
        if ($requester == 'model') {
            $formValue = serialize($formValue);
        }
        return $formValue;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function getItemValue($model)
    {
        if (!$this->_value[$model->id]) {
            $value = parent::getItemValue($model);
            if (is_string($value)) {
                $this->_serialized[$model->id] = $value;
                $value = unserialize($value);
            }
            $this->_value[$model->id] = $value;
        }
        return $this->_value[$model->id];
    }


    /**
     * @param $model
     * @return string
     */
    public function printItemValue($model)
    {
        $value = parent::printItemValue($model);
        if (is_array($value)) {
            return implode(', ', $value);
        }
        return $value;
    }
}
