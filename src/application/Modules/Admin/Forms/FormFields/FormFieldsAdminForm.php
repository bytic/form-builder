<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Forms\FormFields;

use ByTIC\FormBuilder\Application\Library\Form\FormModel;
use ByTIC\FormBuilder\Application\Modules\Admin\Forms\Traits\FieldFormTrait;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;

class FormFieldsAdminForm extends FormModel
{
    use FieldFormTrait;

    public function getModelManager()
    {
        return FormsBuilderModels::fields();
    }

    /**
     * @inheritdoc
     */
    protected function getListingFlags(): array
    {
        return ['public', 'admin'];
    }

    /**
     * @inheritdoc
     */
    protected function getFilterFlags(): array
    {
        return ['public', 'admin'];
    }
}