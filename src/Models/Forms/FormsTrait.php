<?php

namespace ByTIC\FormBuilder\Models\Forms;

use ByTIC\FormBuilder\Utility\PackageConfig;

/**
 * Trait FormsTrait
 * @package ByTIC\FormBuilder\Models\Forms
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
        $this->initRelationsConsumers();
    }

    protected function initRelationsTenant()
    {
        $this->morphTo('Tenant');
    }

    protected function initRelationsConsumers()
    {
        $consumers = PackageConfig::instance()->get('consumers', []);
        foreach ($consumers as $name => $className) {
            $this->initRelationConsumer($name, $className);
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

    protected function generateController(): string
    {
        return Forms::TABLE;
    }
}