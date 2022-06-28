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

    public function process()
    {
        $this->saveToModel();
        $this->getModel()->save();
        $this->saveFormFields();
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
            $field->getType()->saveToModel($this);
        }
    }

    /**
     * @return Record
     */
    abstract public function getModel();

    public function saveFormFields()
    {
        $this->getModel()->getRelation('FormFields')->save();
    }

    /**
     * @return bool
     */
    public function isInAdmin()
    {
        return false;
    }
}
