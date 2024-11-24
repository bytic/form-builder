<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\CustomElements;

use ByTIC\FormBuilder\Application\Models\Forms\Traits\HasFieldsRecordTrait;
use ByTIC\FormBuilder\Application\Models\ModelFields\Traits\ModelFieldsRecordTrait;
use ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits\ModelWithFieldsRecordTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormResponseValues\Actions\FindOrCreateFormValueFromList;
use ByTIC\FormBuilder\FormResponseValues\Actions\FindValuesByFormConsumer;

/**
 * Trait AbstractCustomElementTrait.
 */
trait AbstractCustomElementTrait
{
    use AbstractTypeInterfaceTrait;

    /**
     * @param HasFieldsRecordTrait $model
     *
     * @return bool
     */
    public function getItemValue($model)
    {
        $valueRecord = $this->getFormValueRecord($model);

        return $valueRecord->value;
    }

    /**
     * @param $form
     */
    public function saveToModel($form)
    {
        $model = $this->getModelFromForm($form);
        $valueRecord = $this->getFormValueRecord($model);
        $valueRecord->value = $this->getFormValue($form);

        return $valueRecord;
    }

    protected function getFormValueRecord($model)
    {
        $values = FindValuesByFormConsumer::for($this->getItem()->getFormBuilder(), $model)->handle();

        return FindOrCreateFormValueFromList::for($values)->fieldValue($this->getItem());
    }

    /**
     * @param ModelWithFieldsRecordTrait $model
     *
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
     *
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
     *
     * @return ModelFieldsRecordTrait
     */
//    abstract protected function getNewModelField($model);

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
     * {@inheritdoc}
     */
    public function generateFormName(): string
    {
        return $this->getName().'-'.sha1($this->getItem()->id ?? '');
    }
}
