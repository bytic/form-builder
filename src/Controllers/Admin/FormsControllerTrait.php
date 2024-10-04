<?php

namespace ByTIC\FormBuilder\Controllers\Admin;

use ByTIC\FormBuilder\Utility\FormsBuilderModels;

/**
 * Trait FormsControllerTrait.
 */
trait FormsControllerTrait
{

    protected function generateModelName(): string
    {
        return get_class(FormsBuilderModels::forms());
    }
}
