<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\Behaviours\HasHtmlLabel;
use Nip_Form_Element_Select as FormSelect;
use Nip_Form_Model as NipModelForm;

//use KM42\Register\Modules\Organizers\Library\Forms\ModelForm as OrganizersForm;
//use Race_FormField as RaceField;

/**
 * Trait SelectElementTrait
 * @package ByTIC\FormBuilder\Application\Models\FormFields\Types\Traits
 */
trait SelectElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasHtmlLabel;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('select');
    }

    /**
     * @param FormSelect $input
     * @return mixed
     */
    public function initFormInput($input)
    {
        $this->initFormInputDefaultOption($input);
        $this->initFormInputOptions($input);
        $this->htmlDecodeLabel($input);

        return parent::initFormInput($input);
    }

    /**
     * @param FormSelect $input
     */
    protected function initFormInputDefaultOption($input)
    {
        $noValue = $this->getItem()->getOption('select_no_value');
        if ($noValue) {
            $input->addOption('', $noValue);
        }
    }

    /**
     * @param FormSelect $input
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
     * @var $form NipModelForm
     */
    public function adminGetDataFromModel($form)
    {
        parent::adminGetDataFromModel($form);

        /** @var FormFieldTrait $model */
        $model = $form->getModel();

        $form->addTextarea('select_options', 'Select Options', true);
        $form->getElement('select_options')->setValue(implode("\n", $model->getOption('select_options')));

        $form->addInput('select_no_value', 'Default NoValue', false);
        $form->getElement('select_no_value')->setValue($model->getOption('select_no_value'));
    }

    /**
     * @inheritdoc
     */
    public function adminSaveToModel($form)
    {
        parent::adminSaveToModel($form);

        /** @var FormFieldTrait $model */
        $model = $form->getModel();

        $values = $form->getElement('select_options')->getValue();
        $values = array_map('trim', explode("\n", $values));
        $model->setOption('select_options', $values);

        $model->setOption('select_no_value', $form->getElement('select_no_value')->getValue());
    }
}
