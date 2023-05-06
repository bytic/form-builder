<?php

namespace ByTIC\FormBuilder\FormFields\Actions\Existing;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Base\Actions\Behaviours\HasForm;
use ByTIC\FormBuilder\FormFields\Actions\GenerateInitialFormFields;
use ByTIC\FormBuilder\Forms\Models\Form;
use Nip\Records\Collections\Associated;

class FindOrCreateExistingFields extends Action
{
    use HasForm;

    public function handle(): Associated|array
    {
        $fields = $this->form->getFormFields();
        $count = is_object($fields) ? $fields->count() : count($fields);
        if ($count > 0) {
            return $fields;
        }

        return GenerateInitialFormFields::forForm($this->form)->handle();
    }

    public static function forForm(Form $form)
    {
        $action = new static();
        $action->setForm($form);

        return $action;
    }
}
