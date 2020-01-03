<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Forms\Traits;

/**
 * Trait DynamicFormTrait
 * @package ByTIC\FormBuilder\Application\Modules\Admin\Forms\Traits
 */
trait DynamicFormTrait
{
    use \ByTIC\FormBuilder\Application\Modules\AbstractModule\Forms\Traits\DynamicFormTrait;

    /**
     * @return bool
     */
    public function isInAdmin()
    {
        return true;
    }
}
