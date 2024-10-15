<?php

namespace ByTIC\FormBuilder\FormResponseValues\Actions\Behaviours;

use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use Nip\Records\RecordManager;

trait HasRepository
{
    use \Bytic\Actions\Behaviours\Entities\HasRepository;

    protected function generateRepository(): RecordManager
    {
        return FormsBuilderModels::values();
    }
}