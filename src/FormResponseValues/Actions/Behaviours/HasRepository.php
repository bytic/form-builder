<?php

namespace ByTIC\FormBuilder\FormResponseValues\Actions\Behaviours;

use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use Nip\Records\RecordManager;

trait HasRepository
{
    use HasRepository;

    protected function generateRepository(): BillingStatuses|RecordManager
    {
        return FormsBuilderModels::values();
    }
}