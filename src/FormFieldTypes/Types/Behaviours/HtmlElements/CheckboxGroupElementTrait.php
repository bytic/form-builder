<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasElementOptions;
use Nip_Form_Element_Abstract;
use Nip_Form_Element_CheckboxGroup;
use Nip_Form_Model as NipModelForm;

/**
 * Trait CheckboxGroupElementTrait.
 */
trait CheckboxGroupElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasElementOptions;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('checkboxGroup');
    }

    /**
     * @param Nip_Form_Element_Abstract|Nip_Form_Element_CheckboxGroup $input
     *
     * @return mixed
     */
    public function initFormInput($input)
    {
        $this->populateFormInputOptions($input);
        $input->getRenderer()->setSeparator('');

        return parent::initFormInput($input);
    }

    /**
     * @var NipModelForm
     */
    public function adminGetDataFromModel($form)
    {
        parent::adminGetDataFromModel($form);

        $this->adminFormAddOptionsFromModel($form);
    }

    /**
     * @var NipModelForm
     */
    public function adminSaveToModel($form)
    {
        parent::adminSaveToModel($form);

        $this->adminSaveToModelInputOptions($form);
    }

    /**
     * @param $form
     * @param string $requester
     *
     * @return string
     */
    public function getFormValue($form, $requester = 'model')
    {
        $formValue = $form->getElement($this->getFormName())->getValue($requester);
        if ('model' == $requester) {
            $formValue = serialize($formValue);
        }

        return $formValue;
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function getItemValue($model)
    {
        if (!isset($this->modelValues[$model->id])) {
            $value = parent::getItemValue($model);
            if (is_string($value)) {
//                $this->_serialized[$model->id] = $value;
                $value = unserialize($value);
            }
            $this->modelValues[$model->id] = $value;
        }

        return $this->modelValues[$model->id];
    }

    /**
     * @param $model
     *
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

    protected function getDefaultIcon(): string
    {
        return FieldIcons::CHECKBOXES;
    }
}
