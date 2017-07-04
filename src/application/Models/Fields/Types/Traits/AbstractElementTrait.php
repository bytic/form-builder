<?php

namespace ByTIC\FormBuilder\Application\Models\FormFields\Types\Traits;

use ByTIC\FormBuilder\Application\Modules\Frontend\Forms\Traits\DynamicFormTrait;

/**
 * Trait AbstractElementTrait
 * @package ByTIC\FormBuilder\Application\Models\FormFields\Types\Traits
 */
trait AbstractElementTrait
{

    /**
     * @param DynamicFormTrait $form
     * @return \Nip\Records\Record
     */
    protected function getModelFromForm($form)
    {
        return $form->getModel();
    }

}