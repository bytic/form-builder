<?php

namespace ByTIC\FormBuilder\Models\FormsFields;

/**
 * Trait FormFieldsTrait
 * @package ByTIC\FormBuilder\Models\FormsFields
 */
trait FormFieldsTrait
{
    use \ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
    use \ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
    use \ByTIC\Records\Behaviors\I18n\I18nRecordsTrait;


    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }

    protected function generateController(): string
    {
        return FormsFields::TABLE;
    }
}