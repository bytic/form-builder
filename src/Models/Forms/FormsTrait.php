<?php

namespace ByTIC\FormBuilder\Models\Forms;

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
    }

    protected function initRelationsTenant()
    {
        $this->morphTo('Tenant');
    }

    protected function generateController(): string
    {
        return Forms::TABLE;
    }
}