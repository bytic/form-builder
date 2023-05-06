<?php

namespace ByTIC\FormBuilder\Base\Actions\Behaviours;

use ByTIC\FormBuilder\Forms\Models\Form;

trait HasForm
{
    protected ?Form $form = null;

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function getForm(): Form
    {
        return $this->form;
    }
}