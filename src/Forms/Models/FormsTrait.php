<?php

namespace ByTIC\FormBuilder\Forms\Models;

use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use ByTIC\FormBuilder\Utility\PackageConfig;

/**
 * Trait FormsTrait.
 */
trait FormsTrait
{

    protected function initRelations()
    {
        parent::initRelations();

        $this->initRelationsCommon();
    }

    protected function initRelationsCommon()
    {
        $this->initRelationsTenant();
        $this->initRelationsFormFields();
        $this->initRelationsConsumers();
    }

    protected function initRelationsTenant()
    {
        $this->morphTo('Tenant', ['morphTypeField' => 'tenant', 'morphPrefix' => 'tenant']);
    }

    public function initRelationsFormFields()
    {
        $this->hasMany('FormFields', ['class' => get_class(FormsBuilderModels::fields())]);
    }

    protected function initRelationsConsumers()
    {
        $this->morphedByMany('Consumers', []);
        $consumers = PackageConfig::consumersList()->all();
        foreach ($consumers as $name => $config) {
            $this->initRelationConsumer($name, $config->getRepositoryClass());
        }
    }

    /**
     * @param $name
     * @param null $className
     */
    protected function initRelationConsumer($name, $className = null)
    {
        $this->morphedByMany($name, ['class' => $className, 'fk' => 'id_form']);
    }

    protected function generateTable(): string
    {
        return PackageConfig::tablesForms();
    }

    protected function generateController(): string
    {
        return Forms::TABLE;
    }

    public function generatePrimaryFK(): string
    {
        return 'id_form';
    }
}
