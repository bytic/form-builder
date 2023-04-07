<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use Nip\Form\Elements\AbstractElement;
use Nip_Form_Element_Input_Group;

/**
 *
 */
trait HasElementOptions
{
    protected string $elementsOptionsName = 'check_options';

    /**
     * @param $form
     *
     * @return void
     */
    protected function adminFormAddOptionsFromModel($form, $name = null, $label = null, $required = true)
    {
        $name ??= $this->elementsOptionsName;
        $label ??= translator()->trans($name);

        /** @var FormFieldTrait $model */
        $model = $form->getModel();

        $form->addTextarea($name, $label, $required);

        $selectOptions = $model->getOption($name);
        $selectOptions = is_array($selectOptions) ? $selectOptions : [];
        $form->getElement($name)->setValue(
            implode("\n", $selectOptions)
        );
    }

    /**
     * @param AbstractElement|Nip_Form_Element_Input_Group $input
     */
    protected function populateFormInputOptions($input)
    {
        $values = $this->getItem()->getOption($this->elementsOptionsName);
        if (!is_array($values)) {
            return;
        }
        foreach ($values as $value) {
            $input->addOption($value, $value);
        }
    }

    /**
     * @param $form
     * @param $name
     *
     * @return void
     */
    protected function adminSaveToModelInputOptions($form, $name = null)
    {
        $name = $name ?: $this->elementsOptionsName;

        $values = $form->getElement($name)->getValue();
        $values = array_map('trim', explode("\n", $values));
        $form->getModel()->setOption($name, $values);
    }
}
