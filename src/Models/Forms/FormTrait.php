<?php

namespace ByTIC\FormBuilder\Models\Forms;

use ByTIC\FormBuilder\Models\FormsFields\FormsField;
use Nip\Records\Collections\Associated;

/**
 * Trait FormTrait
 * @package ByTIC\FormBuilder\Models\Forms
 *
 * @method FormsField[]|Associated getFormFields
 */
trait FormTrait
{
    public function hasResponses(): bool
    {
        return false;
    }
}