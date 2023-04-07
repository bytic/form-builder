<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Controllers;

use ByTIC\FormBuilder\Utility\ViewHelper;

trait FormbuilderFormsControllerTrait
{
    public function view()
    {
        parent::view();

        $item = $this->getModelFromRequest();
        $item->getTenant();

        $this->payload()->with(
            [
                'fields' => $item->getFormFields(),
                'fieldsRoles' => [],
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
