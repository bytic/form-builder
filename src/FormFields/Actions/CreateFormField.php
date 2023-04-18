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

    public function handle(): Record
    {
        $this->newField();
        $this->field->save();

        return $this->field;
    }

    protected function newField(): Record
    {
        $this->field = $this->field ?? FormsBuilderModels::fields()->getNew();
        $this->field->populateFromForm($this->form);
        $this->field->setType($this->type->getName());
        $this->field->populateFromType();
        if ($this->role) {
            $this->field->role = $this->role;
        }

        return $this->field;
    }
}