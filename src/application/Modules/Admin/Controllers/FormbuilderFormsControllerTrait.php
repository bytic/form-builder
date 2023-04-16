<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Controllers;

use ByTIC\FormBuilder\FormFields\Actions\GenerateFormFieldsDesigner;
use ByTIC\FormBuilder\Utility\ViewHelper;

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
                'fields' => $item->getFormFields(),
                'designer' => $designer,
                'consumer' => $action->getConsumer(),
                'addWithParams' => [],
                'fieldsRoles' => $designer->getRoles(),
            ]
        );
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
