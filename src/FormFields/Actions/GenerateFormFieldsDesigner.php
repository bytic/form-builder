<?php

namespace ByTIC\FormBuilder\FormFields\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Base\Actions\Behaviours\HasConsumer;
use ByTIC\FormBuilder\Base\Actions\Behaviours\HasConsumerConfig;
use ByTIC\FormBuilder\Base\Actions\Behaviours\HasForm;
use ByTIC\FormBuilder\Consumers\Actions\GetConsumerConfig;
use ByTIC\FormBuilder\FormFields\Actions\Existing\FindOrCreateExistingFields;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner;
use ByTIC\FormBuilder\FormFieldTypes\Actions\FindFieldTypeForConsumer;
use ByTIC\FormBuilder\FormFieldTypes\Dto\FormFieldsList;
use ByTIC\FormBuilder\Forms\Actions\GetConsumerForForm;
use ByTIC\FormBuilder\Forms\Models\Form;

/**
 *
 */
class GenerateFormFieldsDesigner extends Action
{
    use HasForm;
    use HasConsumer;
    use HasConsumerConfig;

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
        $action->setConsumerGenerateCallback(function () use ($form) {
            return GetConsumerForForm::for($form)->handle();
        });

        $action->setConsumerConfigGenerateCallback(function () use ($action) {
            return GetConsumerConfig::forConsumer($action->getConsumer())->handle();
        });

        return $action;
    }

    public function handle(): FormFieldsDesigner
    {
        $this->findRoles();
        $this->findFieldTypes();
        $this->findFieldExisting();

        return $this->fieldsList;
    }


    protected function findRoles(): void
    {
        $roles = $this->getConsumerConfig()->getRoles();

        if (is_array($roles) && is_callable($roles)) {
            $roles = $roles($this->getConsumer());
        }

        $this->fieldsList->setRoles($roles);
    }

    protected function findFieldTypes()
    {
        /** @var FormFieldsList $fieldList */
        $fieldList = FindFieldTypeForConsumer
            ::forConsumer($this->getConsumer(), $this->getConsumerConfig())
            ->handle();

        $roles = $this->fieldsList->getRoles();

        foreach ($roles as $role) {
            $fields = $fieldList->forRole($role);
            foreach ($fields as $field) {
                $this->fieldsList->addAvailable($field, $role);
            }
        }
    }


    protected function findFieldExisting()
    {
        $fields = FindOrCreateExistingFields::forForm($this->form)->handle();
        foreach ($fields as $field) {
            $this->fieldsList->addExisting($field);
        }
    }
}
