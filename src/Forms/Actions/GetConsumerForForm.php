<?php

namespace ByTIC\FormBuilder\Forms\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Forms\Models\Form;

class GetConsumerForForm extends Action
{
    /**
     * @var Form
     */
    protected $form;

    public static function for($form)
    {
        $action = static::make();
        $action->setForm($form);

        return $action;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }

    public function handle()
    {
        $consumerType = $this->form->getConsumerClass();
        $consumers = $this->form->getRelation($consumerType)->getResults();
        if ($consumers->count() == 0) {
            return null;
        }

        return $consumers->first();
    }
}