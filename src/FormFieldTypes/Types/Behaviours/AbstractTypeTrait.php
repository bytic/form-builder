<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours;

use ByTIC\FormBuilder\Application\Modules\Admin\Forms\Traits\FieldFormTrait;
use ByTIC\FormBuilder\Application\Modules\Frontend\Forms\Traits\DynamicFormTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\Generic\HasIconTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\Generic\HasLabelTrait;
use Nip\Records\Record;
use Nip_Form_Element_Abstract as FormElement;
use Nip_Form_Model as Form;

/**
 * Trait AbstractTypeTrait.
 */
trait AbstractTypeTrait
{
    use AbstractTypeInterfaceTrait;
    use HasLabelTrait;
    use HasIconTrait;

    /**
     * AbstractTypeTrait constructor.
     */
    public function __construct()
    {
    }

    /**
     * @var DynamicFormTrait|Form
     *
     * @return FormElement
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
     * @param FormElement $input
     *
     * @return mixed
     */
    public function initFormInput($input)
    {
        /** @var Form $form */
        $form = $input->getForm();
        $model = $this->getModelFromForm($form);
        if ($model instanceof Record) {
            $input->getData($this->getItemValue($model), 'model');
        }

        if ($this->getItem()->getHelp()) {
            $input->setOption('form-help', html_entity_decode($this->getItem()->getHelp()));
        }

        return $input;
    }

    /**
     * @param $model
     *
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
     * @var Form
     */
    public function processValidation($form)
    {
    }

    /**
     * @param Form $form
     */
    public function saveToModel($form)
    {
        $this->getModelFromForm($form)->{$this->getDbName()} = $this->getFormValue($form);
    }

    /**
     * @param DynamicFormTrait|Form $form
     *
     * @return Record
     */
    protected function getModelFromForm($form)
    {
        return $form->getModel();
    }

    /**
     * @param Form   $form
     * @param string $requester
     *
     * @return mixed
     */
    public function getFormValue($form, $requester = 'model')
    {
        return $form->getElement($this->getFormName())->getValue($requester);
    }

    /**
     * @var Form
     */
    public function adminGetDataFromModel($form)
    {
    }

    /**
     * @var Form
     */
    public function adminProcessValidation($form)
    {
    }

    /**
     * @var Form|FieldFormTrait
     */
    public function adminSaveToModel($form)
    {
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function printItemValue($model)
    {
        return $this->getItemValue($model);
    }

    // --------------------------------------------- //
    // --------------- GETTERS & SETTERS ----------- //
    // --------------------------------------------- //

    /**
     * @param Form $form
     * @param Form $siblingForm
     *
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
     * {@inheritdoc}
     */
    public function setInputType($value)
    {
        $this->inputType = $value;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->inputRole;
    }

    /**
     * {@inheritdoc}
     */
    public function setRole($role)
    {
        $this->inputRole = $role;
    }

    /**
     * {@inheritdoc}
     */
    public function setCanDelete(bool $canDelete)
    {
        $this->canDelete = $canDelete;
    }

    /**
     * @return bool
     */
    public function canDelete()
    {
        return true === $this->canDelete;
    }

    public function isUnique(): bool
    {
        return false;
    }

    // --------------------------------------------- //
    // ---------------      DEFAULTS     ----------- //
    // --------------------------------------------- //

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

    /**
     * @return array
     */
    public function getDefaultOptions()
    {
        return [];
    }

}
