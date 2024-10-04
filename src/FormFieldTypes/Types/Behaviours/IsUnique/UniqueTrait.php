<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\IsUnique;

trait UniqueTrait
{

    public function isUnique(): bool
    {
        return false;
    }
}