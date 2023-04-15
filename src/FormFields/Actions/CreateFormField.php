<?php

namespace ByTIC\FormBuilder\FormFields\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;

class CreateFormField extends Action
{
    protected $form;

    protected $type;

    public static function forForm($form, string $type)
    {
        $action = new static();
        $action->setForm($form);
        $action->setType($type);

        return $action;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }

    public function setType($type)
    {
        if (is_string($type)) {
            $type = new $type();
        }
        $this->type = $type;
    }

    public function handle()
    {
        $field = $this->newField();
        $field->save();

        return $field;
    }

    protected function newField()
    {
        $field = FormsBuilderModels::fields()->getNew();
        $field->populateFromForm($this->form);
        $field->setType($this->type->getName());
        $field->populateFromType();

        return $field;
    }
}