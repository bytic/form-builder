<?php

namespace ByTIC\FormBuilder\Application\Modules\AbstractModule\Forms\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use Nip\Records\Record;

/**
 * Trait DynamicFormTrait.
 */
trait DynamicFormTrait
{
    /**
     * @var FormFieldTrait[]
     */
    protected $_fields;

    protected $_formValues = [];

    public function getDataFromModel()
    {
        $this->getDataFromModelFields();
        parent::getDataFromModel();
    }

    public function getDataFromModelFields()
    {
        $fields = $this->getFields();
        foreach ($fields as $field) {
            $field->addFormInput($this);
        }
    }

    public function getModelForRole($role = null)
    {
        return $this->getModel();
    }

    /**
     * @return FormFieldTrait[]
     */
    public function getFields()
    {
        if (!is_array($this->_fields)) {
            $this->initFormFields();
        }

        return $this->_fields;
    }

    protected function initFormFields()
    {
        $this->_fields = $this->generateFormFields();
    }

    abstract protected function generateFormFields();

    public function processValidationFields()
    {
        $fields = $this->getFields();
        foreach ($fields as $field) {
            $field->processValidation($this);
        }
    }

    public function getData()
    {
        $data = parent::getData();

        $fields = $this->getFields();
        foreach ($fields as $field) {
            $data = $field->getType()->getFormData($this, $data);
        }

        return $data;
    }

    public function saveToModel()
    {
        parent::saveToModel();
        $this->saveToModelFields();
    }

    public function saveToModelFields()
    {
        $fields = $this->getFields();
        foreach ($fields as $field) {
            $formValue = $field->getType()->saveToModel($this);
            if ($formValue) {
                $this->_formValues[] = $formValue;
            }
        }
    }

    /**
     * @return Record
     */
    abstract public function getModel();

    public function process()
    {
        parent::process();
        $this->saveFormFields();
    }

    public function saveFormFields()
    {
        foreach ($this->_formValues as $formValue) {
            $field = $formValue->getFormField();
            $model = $field->getType()->getModelFromForm($this);
            $formValue->consumer_id = $model->id;
            $formValue->save();
        }
    }

    /**
     * @return bool
     */
    public function isInAdmin()
    {
        return false;
    }
}
