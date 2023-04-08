<?php

namespace ByTIC\FormBuilder\FormFields\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Consumers\Models\Consumer;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner;
use ByTIC\FormBuilder\Forms\Models\Form;

/**
 *
 */
class GenerateFormFieldsDesigner extends Action
{
    protected ?Form $form = null;
    protected ?Consumer $consumer = null;

    protected FormFieldsDesigner $fieldsList;

    /**
     * @param FormFieldsDesigner|null $fieldsList
     */
    public function __construct(?FormFieldsDesigner $fieldsList = null)
    {
        $this->fieldsList = $fieldsList ?? new FormFieldsDesigner();
    }

    public static function forForm(Form $form, $fieldList = null)
    {
        $action = new static($fieldList);
        $action->setForm($form);
        $action->setConsumer($form->getConsumer());

        return $action;
    }

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
    }

    public function handle(): FormFieldsDesigner
    {
        $this->findFieldTypes();
        return $this->fieldsList;
    }

    protected function findFieldTypes()
    {
        $names = $this->findFieldTypesNames();
        $fields = [];
        foreach ($names as $name) {
            $type = new $name();
            $this->fieldsList->addAvailable($type);
        }
    }

    /**
     * @return array
     */
    protected function findFieldTypesNames()
    {
        if (method_exists($this->consumer, 'getFormBuilderFieldTypeAvailable')) {
            $fields = $this->consumer->getFormBuilderFieldTypeAvailable();
            return $fields;
        }

        return [];
    }
}

