<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeTrait;

/**
 * Trait FormFieldTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits
 *
 * @property string $id
 * @property string $label
 * @property string $role
 * @property string $help
 * @property string $mandatory
 * @property string $visible
 * @property string $listing
 * @property string $filter
 *
 */
trait FormFieldTrait
{
    /**
     * @param $form
     * @return mixed
     */
    public function addFormInput($form)
    {
        return $this->getType()->addFormInput($form);
    }

    /**
     * @return AbstractTypeTrait
     */
    abstract public function getType();

    /**
     * @param $form
     * @return void
     */
    public function processValidation($form)
    {
        $this->getType()->processValidation($form);
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label ? $this->label : $this->getType()->getLabel();
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        return $this->help;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function getItemValue($model)
    {
        return $this->getType()->getItemValue($model);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function printItemValue($model)
    {
        $value = $this->getType()->printItemValue($model);
        return $value;
    }

    /**
     * @param $form
     * @param $siblingForm
     * @return mixed
     */
    public function populateFormFromSibling($form, $siblingForm)
    {
        return $this->getType()->populateFormFromSibling($form, $siblingForm);
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return $this->visible != 'no';
    }

    /**
     * @return bool
     */
    public function isMandatory()
    {
        return $this->mandatory != 'no';
    }
}
