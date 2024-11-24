<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\Generic;

trait HasFormName
{
    protected ?string $formName = null;

    public function getFormName(): string
    {
        if ($this->formName === null) {
            $this->initFormName();
        }

        return $this->formName;
    }

    public function setFormName($formName)
    {
        $this->formName = $formName;
    }

    protected function initFormName()
    {
        $this->formName = $this->generateFormName();
    }

    protected function generateFormName()
    {
        return $this->getName();
    }
}