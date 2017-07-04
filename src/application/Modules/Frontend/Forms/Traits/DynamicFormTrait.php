<?php

namespace ByTIC\FormBuilder\Application\Modules\Frontend\Forms\Traits;

use Nip\Records\Record;

/**
 * Trait DynamicFormTrait
 * @package ByTIC\FormBuilder\Application\Modules\Frontend\Forms\Traits
 */
trait DynamicFormTrait
{

    /**
     * @return Record
     */
    abstract function getModel();
}
