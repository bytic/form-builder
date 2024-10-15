<?php

namespace ByTIC\FormBuilder\Consumers\Models;

use ByTIC\FormBuilder\Utility\PackageConfig;

trait ConsumersRepositoryTrait
{

    protected function initRelations(): void
    {
        parent::initRelations();

        $this->initRelationsFormBuilder();
    }

    protected function initRelationsFormBuilder(): void
    {
        $this->initRelationsFormBuilderForms();
    }

    protected function initRelationsFormBuilderForms()
    {
        $this->morphToMany(
            'FormBuilderForms',
            ['class' => PackageConfig::modelsForms(), 'pivotForeignKey' => 'id_form']
        );

        $this->morphMany(
            'FormBuilderValues',
            ['class' => PackageConfig::modelsValues(), 'morphPrefix' => 'consumer', 'morphTypeField' => 'consumer']
        );
    }
}
