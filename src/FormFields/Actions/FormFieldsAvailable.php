<?php

namespace ByTIC\FormBuilder\FormFields\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsList;
use ByTIC\FormBuilder\Utility\PackageConfig;

class FormFieldsAvailable extends Action
{
    protected FormFieldsList $fieldsList;

    /**
     * @param FormFieldsList $fieldsList
     */
    public function __construct(FormFieldsList $fieldsList = null)
    {
        $this->fieldsList = $fieldsList ?? new FormFieldsList();
    }


    public function handle(): FormFieldsAvailable
    {
        $this->findFieldTypes();
        return $this;
    }

    protected function findFieldTypes()
    {
        $names = PackageConfig::value('fields.classmap');
        foreach ($names as $name) {
            $type = new $name();
            $this->fieldsList->add($type);
        }
    }
}