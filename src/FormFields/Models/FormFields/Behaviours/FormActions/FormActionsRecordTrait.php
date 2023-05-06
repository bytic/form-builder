<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields\Behaviours\FormActions;

trait FormActionsRecordTrait
{
    /**
     * @param $form
     *
     * @return void
     */
    public function processValidation($form)
    {
        $this->getType()->processValidation($form);
    }

    public function getFormData($form, $data = [])
    {
        return $this->getType()->getFormData($form, $data);
    }
}

