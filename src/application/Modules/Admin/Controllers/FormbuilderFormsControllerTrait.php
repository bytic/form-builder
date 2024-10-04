<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Controllers;

use ByTIC\FormBuilder\FormFields\Actions\GenerateFormFieldsDesigner;
use ByTIC\FormBuilder\Forms\Models\Form;
use ByTIC\FormBuilder\Utility\ViewHelper;

/**
 * @method Form getModelFromRequest()
 */
trait FormbuilderFormsControllerTrait
{
    public function view()
    {
        parent::view();

        $item = $this->getModelFromRequest();
        $tenant = $item->getTenant();
        if (!is_object($tenant)) {
            $this->dispatchNotFoundResponse();
        }

        $action = GenerateFormFieldsDesigner::forForm($item);
        $designer = $action->handle();

        $this->payload()->with(
            [
                'formBuilder' => $item,
                'fields' => $item->getFormFields(),
                'designer' => $designer,
                'consumer' => $action->getConsumer(),
                'addWithParams' => [],
                'fieldsRoles' => $designer->getRoles(),
            ]
        );
    }

    public function order()
    {
        $form = $this->getModelFromRequest();

        parse_str($_POST['order'], $order);
        $idFields = $order['field'];

        $fields = $form->getFormFields();
        $fields = $fields->keyBy('id');

        if (count($fields) < 1) {
            $this->Async()->sendMessage('No fields', 'error');
        }

        foreach ($idFields as $pos => $idField) {
            $field = $fields[$idField];
            if ($field) {
                $field->pos = $pos + 1;
                $field->update();
            }
        }

        $this->Async()->sendMessage('Fields reordered');
    }

    protected function bootFormbuilderFormsControllerTrait()
    {
        $this->after(
            function () {
                $this->registerFormbuilderViewPaths();
            }
        );
    }

    protected function registerFormbuilderViewPaths()
    {
        $view = $this->getView();
        ViewHelper::registerAdminPaths($view);
    }
}
