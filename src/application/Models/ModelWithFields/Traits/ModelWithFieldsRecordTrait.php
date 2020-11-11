<?php

namespace ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits;

use ByTIC\Common\Records\Records;
use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use Nip\Records\Collections\Associated as AssociatedCollection;
use Nip\Records\Relations\HasMany;

/**
 * Trait ModelWithFieldsRecordTrait
 * @package ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits
 *
 * @method HasMany getRelation($relationName)
 * @method Records getManager()
 */
trait ModelWithFieldsRecordTrait
{
    protected $formFieldsList = null;

    /**
     * @return array
     * @throws \Exception
     */
    public function getFormFieldsList()
    {
        if ($this->formFieldsList === null) {
            $this->initFormFieldsList();
        }
        return $this->formFieldsList;
    }

    /**
     * @throws \Exception
     */
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

        $fieldsManager = $this->getFormFieldsManager();

        $roles = $fieldsManager->getRoles();
        foreach ($roles as $role) {
            $fields[$role] = $fieldsManager->getTypesByRole($role);
            $fields['existing.' . $role] = [];
        }
        $fields['custom'] = $fieldsManager->getTypesByRole('custom');

        $existing = $this->getFormFields();
        foreach ($existing as $field) {
            $fields['existing.' . $field->getRole()][] = $field;
            unset($fields[$field->getRole()][$field->getType()->getName()]);
        }

        return $fields;
    }

    /**
     * @return AssociatedCollection|FormFieldTrait[]
     * @throws \Exception
     */
    public function getFormFields()
    {
        if (is_callable($this, 'parent::getFormFields')) {
            $fields = parent::getFormFields();
        } else {
            $fields = $this->getFormFieldsRelation()->getResults();
        }
        if (count($fields) < 1) {
            $fields = $this->initDefaultFormFields();
        }
        return $fields;
    }

    /**
     * @return \Nip\Records\Collections\Collection
     * @throws \Exception
     */
    protected function initDefaultFormFields()
    {
        $types = method_exists($this, 'generateDefaultFormFieldsTypes')
            ? $this->generateDefaultFormFieldsTypes()
            : [];

        return $this->checkHasFieldsTypes($types);
    }

    /**
     * @param array $types
     * @return AssociatedCollection|\Nip\Records\Collections\Collection
     * @throws \Exception
     */
    protected function checkHasFieldsTypes($types)
    {
        $fieldsManager = $this->getFormFieldsManager();
        $fieldsRelation = $this->getFormFieldsRelation();
        $fields = $fieldsRelation->getResults();
        foreach ($types as $type) {
            $field = $fieldsManager->getNew();
            $field->setType($type);
            $field->populateFromParent($this);
            $field->populateFromType();

            if ($this->isInDB()) {
                $field->insert();
            }
            $fields->add($field);
        }
//        $fieldsRelation->setResults($fields);
        return $fields;
    }

    /**
     * @return FormFieldsTrait|\Nip\Records\RecordManager
     * @throws \Exception
     */
    protected function getFormFieldsManager()
    {
        return $this->getFormFieldsRelation()->getWith();
    }

    /**
     * @return HasMany
     */
    protected function getFormFieldsRelation()
    {
        return $this->getRelation('FormFields');
    }
}
