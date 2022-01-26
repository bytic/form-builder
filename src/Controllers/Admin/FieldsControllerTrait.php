<?php

namespace ByTIC\FormBuilder\Controllers\Admin;

use ByTIC\FormBuilder\Models\Forms\Form;
use ByTIC\FormBuilder\Models\Forms\Forms;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;

/**
 * Trait FieldsControllerTrait
 * @package ByTIC\FormBuilder\Controllers\Admin
 */
trait FieldsControllerTrait
{
    public function builder()
    {
        $form = $this->checkForeignModelFromRequest(Forms::TABLE, 'id_form');
        $fields = $form->getFormFields();

        $this->payload()->with([
            'form' => $form,
            'fields' => $fields,
        ]);
    }

    public function reset()
    {
        /** @var Form $race */
        $form = $this->checkForeignModelFromRequest(Forms::TABLE, 'id_form');

        $redirect = $this->_urls['after-edit'];

        if ($form->hasResponses() > 0) {
            $this->flashRedirect($this->getModelManager()->getMessage('reset.has-reponses'), $redirect, 'error');
        }

        $fields = $form->getFormFields();
        $fields->delete();

        $this->flashRedirect($this->getModelManager()->getMessage('reset'), $redirect, 'success');
    }

    protected function generateModelName(): string
    {
        return get_class(FormsBuilderModels::fields());
    }
}
