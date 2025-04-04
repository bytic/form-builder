<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Actions;

use Bytic\Actions\Action;

class InstanceFormFieldType extends Action
{

    protected $form;

    protected $consumer;

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
        $this->type = $type;
    }

    public function handle()
    {
        if (class_exists($this->type)) {
            return new $this->type;
        }

        $list = FindFieldTypeForConsumer::forForm($this->form)->handle();

        return $list->get($this->type);
    }
}
