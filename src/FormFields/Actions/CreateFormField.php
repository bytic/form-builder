<?php

namespace ByTIC\FormBuilder\FormFields\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\FormFieldTypes\Actions\InstanceFormFieldType;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use Nip\Records\Record;

class CreateFormField extends Action
{
    protected $form;

    protected $type;

    protected ?string $role = null;

    protected $field = null;

    public static function forForm($form, string $type)
    {
        $action = new static();
        $action->setForm($form);
        $action->setType($type);

        return $action;
    }

    /**
     * @param $field
     * @return $this
     */
    public function setField($field): static
    {
        $this->field = $field;
        $this->populateField();

        return $this;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }

    public function setType($type)
    {
        if (is_string($type)) {
            $type = InstanceFormFieldType::forForm($this->form, $type)->handle();
        }
        $this->type = $type;

        return $this;
    }

    public function setRole($role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getField()
    {
        if ($this->field === null) {
            $this->initField();
        }

        return $this->field;
    }

    public function handle(): ?Record
    {
        return $this->createWithSave();
    }

    public function createUnsaved(): ?Record
    {
        $field = $this->getField();
        if (false == $this->canCreate()) {
            return null;
        }

        return $field;
    }

    /**
     * @return mixed|null
     */
    public function createWithSave(): ?Record
    {
        $field = $this->createUnsaved();
        $field?->save();

        return $field;
    }

    protected function initField(): Record
    {
        $this->field = $this->field ?? FormsBuilderModels::fields()->getNew();
        $this->populateField();

        return $this->field;
    }

    protected function populateField($field = null)
    {
        $field = $field ?? $this->field;
        $field->populateFromForm($this->form);
        $field->setType($this->type->getName());
        $field->populateFromType();
        if ($this->role) {
            $field->role = $this->role;
        }

        return $field;
    }

    public function canCreate(): bool
    {
        $type = $this->type;
        if (false == $type->isUnique()) {
            return true;
        }
        $fields = $this->form->getFormFields();
        $types = $fields->pluck('type')->toArray();
        if (in_array($type->getName(), $types)) {
            return false;
        }

        return true;
    }
}