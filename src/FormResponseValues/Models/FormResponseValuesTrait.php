<?php

namespace ByTIC\FormBuilder\FormResponseValues\Models;

use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use ByTIC\FormBuilder\Utility\PackageConfig;

/**
 * Trait FormsTrait.
 */
trait FormResponseValuesTrait
{

    public function generatePrimaryFK(): string
    {
        return 'id_value';
    }

    protected function initRelations()
    {
        parent::initRelations();

        $this->initRelationsCommon();
    }

    protected function initRelationsCommon()
    {
        $this->initRelationsForm();
        $this->initRelationsFormField();
        $this->initRelationsConsumers();
    }

    protected function initRelationsForm()
    {
    }

    public function initRelationsFormField()
    {
        $this->belongsTo(
            'FormField',
            ['class' => get_class(FormsBuilderModels::fields()), 'fk' => 'id_field']
        );
    }

    protected function initRelationsConsumers()
    {
//        $this->morphedyMany('Consumers', []);
//        $consumers = PackageConfig::consumersList()->all();
//        foreach ($consumers as $name => $config) {
//            $this->initRelationConsumer($name, $config->getRepositoryClass());
//        }
    }

    protected function generateTable(): string
    {
        return PackageConfig::tablesValues();
    }

    protected function generateController(): string
    {
        return FormResponseValues::TABLE;
    }
}
