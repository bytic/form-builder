<?php

use ByTIC\FormBuilder\Models\Fields\Fields;
use ByTIC\FormBuilder\Models\Forms\Forms;
use ByTIC\FormBuilder\Models\Values\Values;

return [
    'models' => [
        'forms' => Forms::class,
        'fields' => Fields::class,
        'values' => Values::class,
    ],
    'tables' => [
        'forms' => Forms::TABLE,
        'fields' => Fields::TABLE,
        'values' => Values::TABLE,
    ],
];
