<?php

namespace ByTIC\FormBuilder\Models\Forms;

use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use ByTIC\FormBuilder\Utility\PackageConfig;

/**
 * Trait FormsTrait.
 */
trait FormsTrait
{
    use TimestampableTrait;

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
        $this->morphTo('Tenant');
    }

    public function initRelationsFormFields()
    {
        $this->hasMany('FormFields', ['class' => get_class(FormsBuilderModels::fields())]);
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

    protected function generateTable(): string
    {
        return PackageConfig::tablesForms();
    }

    protected function generateController(): string
    {
        return Forms::TABLE;
    }
}
