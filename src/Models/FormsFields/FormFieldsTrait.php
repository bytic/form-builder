<?php

namespace ByTIC\FormBuilder\Models\FormsFields;

use ByTIC\FormBuilder\Utility\PackageConfig;
use ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
use ByTIC\Records\Behaviors\I18n\I18nRecordsTrait;

/**
 * Trait FormFieldsTrait.
 */
trait FormFieldsTrait
{
    use \ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
    use HasFormsRecordsTrait;
    use I18nRecordsTrait;

    public function getRootNamespace(): string
    {
        return 'ByTIC\FormBuilder\Models\\';
    }

    protected function generateTable(): string
    {
        return PackageConfig::tablesFields();
    }

    protected function generateController(): string
    {
        return FormsFields::TABLE;
    }
}
