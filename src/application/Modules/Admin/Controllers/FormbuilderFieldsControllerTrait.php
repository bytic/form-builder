<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Controllers;

use ByTIC\FormBuilder\FormFields\Models\FormFields\FormFieldTrait;
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
}
