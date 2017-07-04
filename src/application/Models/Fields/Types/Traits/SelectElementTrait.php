<?php

namespace ByTIC\FormBuilder\Application\Models\FormFields\Types\Traits;

//use KM42\Register\Modules\Organizers\Library\Forms\ModelForm as OrganizersForm;
//use Race_FormField as RaceField;

/**
 * Trait SelectElementTrait
 * @package ByTIC\FormBuilder\Application\Models\FormFields\Types\Traits
 */
trait SelectElementTrait
{
    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->inputType = 'select';
    }

    /**
     * @param \Nip_Form_Element_Select $input
     * @return mixed
     */
    public function initFormInput($input)
    {
        $this->initFormInputDefaultOption($input);
        $this->initFormInputOptions($input);

        return parent::initFormInput($input);
    }

    /**
     * @param \Nip_Form_Element_Select $input
     */
    protected function initFormInputDefaultOption($input)
    {
        $noValue = $this->getItem()->getOption('select_no_value');
        if ($noValue) {
            $input->addOption('', $noValue);
        }
    }

    /**
     * @param \Nip_Form_Element_Select $input
     */
    protected function initFormInputOptions($input)
    {
        $values = $this->getItem()->getOption('select_options');
        if (is_array($values)) {
            foreach ($values as $value) {
                $input->addOption($value, $value);
            }
        }
    }

    /**
     * @var $form OrganizersForm
     */
    public function adminGetDataFromModel($form)
    {
        parent::adminGetDataFromModel($form);

        $model = $this->getModelFromForm($form);

        $form->addTextarea('select_options', 'Select Options', true);
        $form->getElement('select_options')->setValue(implode("\n", $model->getOption('select_options')));

        $form->addInput('select_no_value', 'Default NoValue', false);
        $form->getElement('select_no_value')->setValue($model->getOption('select_no_value'));
    }

    /**
     * @param $form
     */
    public function adminSaveToModel($form)
    {
        parent::adminSaveToModel($form);
        $model = $this->getModelFromForm($form);

        $values = $form->getElement('select_options')->getValue();
        $values = array_map('trim', explode("\n", $values));
        $model->setOption('select_options', $values);

        $model->setOption('select_no_value', $form->getElement('select_no_value')->getValue());
    }
}
