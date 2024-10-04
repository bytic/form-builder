<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\CanDelete;

/**
 *
 */
trait CannotDeleteTrait
{

    protected function canDeleteDefault(): bool
    {
        return false;
    }
}