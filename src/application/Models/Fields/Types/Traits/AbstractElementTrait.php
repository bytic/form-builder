<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits;

use ByTIC\FormBuilder\Application\Modules\Frontend\Forms\Traits\DynamicFormTrait;

/**
 * Trait AbstractElementTrait
 * @package ByTIC\FormBuilder\Application\Models\FormFields\Types\Traits
 */
trait AbstractElementTrait
{
    protected $inputType = 'input';

    protected $inputRole = 'custom';

    protected $canDelete = true;

    /**
     * @return string
     */
    public function generateLabel()
    {
        return $this->getDefaultLabel();
    }

    /**
     * @return string
     */
    public function getDefaultLabel()
    {
        return $this->getName();
    }

    /**
     * @var DynamicFormTrait|\Nip_Form_Model $form
     * @return \Nip_Form_Element_Abstract
     */
    public function addFormInput($form)
    {
        $form->add(
            $this->getFormName(),
            $this->getItem()->getLabel(),
            $this->getInputType(),
            $this->getItem()->isMandatory()
        );
        $input = $form->getElement($this->getFormName());
        $this->initFormInput($input);

        return $input;
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getInputType()
    {
        return $this->inputType;
    }

    /**
     * @param Form_Element $input
     * @return mixed
     */
    public function initFormInput($input)
    {
        /** @var DefaultForm $form */
        $form = $input->getForm();
        $input->getData($this->getItemValue($form->getModel()), 'model');

        if ($this->getItem()->getHelp()) {
            $input->setOption('form-help', html_entity_decode($this->getItem()->getHelp()));
        }

        return $input;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function getItemValue($model)
    {
        return $model->{$this->getDbName()};
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->getName();
    }

    /**
     * @var $form DefaultForm
     */
    public function processValidation($form)
    {
    }

    /**
     * @param DefaultForm|DefaultCompetitorForm $form
     */
    public function saveToModel($form)
    {
        $this->getModelFromForm($form)->{$this->getDbName()} = $this->getFormValue($form);
    }

    /**
     * @param DynamicFormTrait $form
     * @return \Nip\Records\Record
     */
    protected function getModelFromForm($form)
    {
        return $form->getModel();
    }

    /**
     * @param DefaultForm $form
     * @param string $requester
     * @return mixed
     */
    public function getFormValue($form, $requester = 'model')
    {
        return $form->getElement($this->getFormName())->getValue($requester);
    }

    /**
     * @var $form OrganizersForm
     */
    public function adminGetDataFromModel($form)
    {
    }

    /**
     * @var $form OrganizersForm
     */
    public function adminProcessValidation($form)
    {
    }

    /**
     * @var $form OrganizersForm
     */
    public function adminSaveToModel($form)
    {
    }

    /**
     * @param $model
     * @return mixed
     */
    public function printItemValue($model)
    {
        return $this->getItemValue($model);
    }

    /**
     * @param DefaultForm $form
     * @param DefaultForm $siblingForm
     * @return $this
     */
    public function populateFormFromSibling($form, $siblingForm)
    {
        $input = $form->getElement($this->getFormName());
        $inputSibling = $siblingForm->getElement($this->getFormName());
        if ($inputSibling) {
            $input->getData($inputSibling->getValue('model'), 'model');
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultVisible()
    {
        return 'yes';
    }

    /**
     * @return string
     */
    public function getDefaultMandatory()
    {
        return 'no';
    }


    // --------------- GETTERS & SETTERS ----------- //

    /**
     * @return []
     */
    public function getDefaultOptions()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->inputRole;
    }

    /**
     * @return bool
     */
    public function canDelete()
    {
        return $this->canDelete === true;
    }

    /**
     * @inheritdoc
     */
    protected function hasShortLabel()
    {
        return false;
    }

}