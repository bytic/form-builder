<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\CustomElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\Application\Models\Form\Traits\HasFieldsRecordTrait;
use ByTIC\FormBuilder\Application\Models\ModelFields\Traits\ModelFieldsRecordTrait;
use ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits\ModelWithFieldsRecordTrait;
use Nip_Form_Element_Abstract as FormElement;

/**
 * Trait AbstractCustomElementTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits
 */
trait AbstractCustomElementTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * @param FormElement $input
     * @return mixed
     */
    public function initFormInput($input)
    {
        $form = $input->getForm();
        $model = $this->getModelFromForm($form);

        $fields = $model->getFormFields();

        if (is_object($fields[$this->getItem()->id])) {
            $input->getData($this->getItemValue($model), 'model');
        }

        if ($this->getItem()->help) {
            $input->setOption('form-help', html_entity_decode($this->getItem()->help));
        }

        return $input;
    }

    /**
     * @param HasFieldsRecordTrait $model
     * @return bool
     */
    public function getItemValue($model)
    {
        $fields = $model->getFormFields();
        if (is_object($fields[$this->getItem()->id])) {
            return $fields[$this->getItem()->id]->getValue();
        }
        return false;
    }

    /**
     * @param $form
     */
    public function saveToModel($form)
    {
        $model = $this->getModelFromForm($form);
        $field = $this->initModelField($model);
        $field->value = $this->getFormValue($form);
    }

    /**
     * @param ModelWithFieldsRecordTrait $model
     * @return ModelFieldsRecordTrait
     */
    protected function initModelField($model)
    {
        $fields = $model->getFormFields();

        if (is_object($fields[$this->getItem()->id])) {
            return $fields[$this->getItem()->id];
        }

        $field = $this->generateModelField($model);
        $fields->add($field);

        return $field;
    }

    /**
     * @param $model
     * @return ModelFieldsRecordTrait
     */
    protected function generateModelField($model)
    {
        $field = $this->getNewModelField($model);
        $field->populateFromField($this->getItem());
        return $field;
    }

    /**
     * @param $model
     * @return ModelFieldsRecordTrait
     */
    abstract protected function getNewModelField($model);

    public function populateFormFromSibling($form, $siblingForm)
    {
        $input = $form->getElement($this->getFormName());
        $inputSibling = $siblingForm->getElementByLabel($this->getItem()->getLabel());
        if ($inputSibling) {
            $input->getData($inputSibling->getValue('model'), 'model');
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFormName()
    {
        return $this->getName() . '-' . sha1($this->getItem()->id);
    }
}
