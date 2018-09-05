<?php

namespace ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use ByTIC\FormBuilder\Application\Models\ModelFields\Traits\ModelFieldsRecordTrait;
use Nip\Records\Collections\Collection;
use Nip\Records\Record;
use Nip\Records\Relations\HasMany;

/**
 * Trait ModelWithFieldsRecordTrait
 * @package ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits
 *
 * @method HasMany getRelation($relationName)
 * @method ModelFieldsRecordTrait[]|Record[]|Collection getFormFields()
 */
trait ModelWithFieldsRecordTrait
{

    protected $formFieldsList = null;

    /**
     * @return array
     */
    public function getFormFieldsList()
    {
        if ($this->formFieldsList === null) {
            $this->initFormFieldsList();
        }
        return $this->formFieldsList;
    }

    protected function initFormFieldsList()
    {
        $this->formFieldsList = $this->generateFormFieldsList();
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function generateFormFieldsList()
    {
        $fields = [];

        /** @var FormFieldsTrait $fieldsManager */
        $fieldsManager = $this->getRelation('FormFields')->getWith();

        $roles = $fieldsManager->getRoles();
        foreach ($roles as $role) {
            $fields[$role] = $fieldsManager->getTypesByRole($role);
            $fields['existing.' . $role] = [];
        }
        $fields['custom'] = $fieldsManager->getTypesByRole('custom');

        $existing = $this->getFormFields();
        foreach ($existing as $field) {
            $fields['existing.' . $field->getRole()][] = $field;
            unset($fields[$field->role][$field->type]);
        }

        return $fields;
    }
}
