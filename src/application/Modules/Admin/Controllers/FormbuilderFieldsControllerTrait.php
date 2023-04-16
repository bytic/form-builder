<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Controllers;

use ByTIC\FormBuilder\Application\Modules\Admin\Forms\FormFields\FormFieldsAdminForm;
use ByTIC\FormBuilder\FormFields\Models\FormFields\FormFieldTrait;
use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsField;
use ByTIC\FormBuilder\Utility\ViewHelper;
use Nip\Controllers\Traits\AbstractControllerTrait;

/**
 * Class FormFieldsControllerTrait.
 */
trait FormbuilderFieldsControllerTrait
{
    use AbstractControllerTrait;

    /**
     * {@inheritdoc}
     */
    public function addNewModel()
    {
        /** @var FormFieldTrait $item */
        $item = parent::addNewModel();
        $item->setType($this->getRequest()->query->get('type'));
        $item->role = $this->getRequest()->query->get('role');
        $item->populateFromType();

        return $item;
    }

    public function order()
    {
        parse_str($_POST['order'], $order);
        $idFields = $order['field'];

        $fields = $this->getModelManager()->findByPrimary($idFields);
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
            'after-delete'
        );

        $this->afterActionRedirect('delete', $item);
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
