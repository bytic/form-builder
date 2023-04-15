<?php

namespace ByTIC\FormBuilder\FormFields\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Consumers\Actions\GetConsumerConfig;
use ByTIC\FormBuilder\Consumers\Dto\ConsumerConfig;
use ByTIC\FormBuilder\Consumers\Models\Consumer;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner;
use ByTIC\FormBuilder\Forms\Actions\GetConsumerForForm;
use ByTIC\FormBuilder\Forms\Models\Form;

/**
 *
 */
class GenerateFormFieldsDesigner extends Action
{
    protected ?Form $form = null;
    protected ?Consumer $consumer = null;
    protected ?ConsumerConfig $consumerConfig = null;

    protected FormFieldsDesigner $fieldsList;

    /**
     * @param FormFieldsDesigner|null $fieldsList
     */
    protected function __construct(?FormFieldsDesigner $fieldsList = null)
    {
        $this->fieldsList = $fieldsList ?? new FormFieldsDesigner();
    }

    public static function forForm(Form $form, $fieldList = null)
    {
        $action = new static($fieldList);
        $action->setForm($form);

        return $action;
    }

    public function handle(): FormFieldsDesigner
    {
        $this->findRoles();
        $this->findFieldTypes();
        $this->findFieldExisting();

        return $this->fieldsList;
    }

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
    }

    public function getConsumer(): Consumer
    {
        if ($this->consumer === null) {
            $this->consumer = GetConsumerForForm::for($this->form)->handle();
        }

        return $this->consumer;
    }

    public function getConsumerConfig(): ConsumerConfig
    {
        if ($this->consumerConfig === null) {
            $this->consumerConfig = GetConsumerConfig::forConsumer($this->getConsumer())->handle();
        }

        return $this->consumerConfig;
    }

    public function setConsumerConfig(ConsumerConfig $consumerConfig): void
    {
        $this->consumerConfig = $consumerConfig;
    }

    protected function findRoles(): void
    {
        $roles = $this->getConsumerConfig()->getRoles();
        $this->fieldsList->setRoles($roles);
    }

    protected function findFieldTypes()
    {
        $roles = $this->findFieldTypesNames();
        if (!is_array($roles)) {
            return;
        }
        foreach ($roles as $role => $names) {
            if (!is_array($names)) {
                continue;
            }
            foreach ($names as $name) {
                $type = new $name();
                $this->fieldsList->addAvailable($type, $role);
            }
        }
    }

    /**
     * @return array
     */
    protected function findFieldTypesNames()
    {
        $consumer = $this->getConsumer();
        if (method_exists($consumer, 'getFormBuilderFieldTypeAvailable')) {
            $fields = $consumer->getFormBuilderFieldTypeAvailable();

            return $fields;
        }

        return $this->getConsumerConfig()->getFields();
    }

    protected function findFieldExisting()
    {
        $fields = $this->guardFieldExisting();
        foreach ($fields as $field) {
            $this->fieldsList->addExisting($field);
        }
    }

    protected function guardFieldExisting()
    {
        $fields = $this->form->getFormFields();
        $count = is_object($fields) ? $fields->count() : count($fields);
        if ($count > 0) {
            return $fields;
        }

        return GenerateInitialFormFields::forForm($this->form)->handle();
    }
}

