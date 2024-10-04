<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Controllers;

use ByTIC\FormBuilder\Application\Modules\Admin\Forms\FormFields\FormFieldsAdminForm;
use ByTIC\FormBuilder\FormFields\Actions\CreateFormField;
use ByTIC\FormBuilder\FormFields\Models\FormFields\FormFieldTrait;
use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsField;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use ByTIC\FormBuilder\Utility\ViewHelper;
use Nip\Controllers\Traits\AbstractControllerTrait;

/**
 * Class FormFieldsControllerTrait.
 */
trait FormbuilderFieldsControllerTrait
{
    use AbstractControllerTrait;

    public function add()
    {
        $record = $this->addNewModel();
        $this->addRedirect($record);
    }

    /**
     * {@inheritdoc}
     */
    public function addNewModel()
    {
        /** @var FormFieldTrait $item */
        $item = parent::addNewModel();

        $formsRepository = FormsBuilderModels::forms();
        $form = $this->checkForeignModelFromRequest(
            $formsRepository->getController(),
            [$formsRepository->getPrimaryFK(), 'id']
        );
        $action = CreateFormField::forForm($form, $this->getRequest()->query->get('type'));
        $action->setField($item);
        $action->setRole($this->getRequest()->query->get('role'));

        return $action->handle();
    }


    /**
     * @param FormsField $item
     * @return void
     */
    protected function deleteRedirect($item)
    {
        $form = $item->getFormBuilder();

        $this->setAfterUrlFlash(
            $form->getURL(),
            $form->getManager()->getController(),
            ['after-delete']
        );

        $this->afterActionRedirect('delete', $item);
    }

    public function addRedirect($item)
    {
        $form = $item->getFormBuilder();

        $this->setAfterUrlFlash(
            $form->getURL(),
            $form->getManager()->getController(),
            ['after-add']
        );

        parent::addRedirect($item);
    }

    /**
     * @param FormsField $model
     * @param string $action
     * @return string
     */
    public function getModelForm($model, $action = null)
    {
        if ($action == null || in_array($action, ['edit', 'view'])) {
            $form = new FormFieldsAdminForm();
            $form->setModel($model);

            return $form;
        }

        return parent::getModelForm($model, $action);
    }

    protected function bootFormbuilderFieldsControllerTrait()
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
