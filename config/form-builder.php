<?php

use ByTIC\FormBuilder\Models\FormsFields\FormsFields;
use ByTIC\FormBuilder\Models\Forms\Forms;
use ByTIC\FormBuilder\Models\FieldsValues\FieldsValues;

return [
    'models' => [
        'forms' => Forms::class,
        'fields' => FormsFields::class,
        'values' => FieldsValues::class,
    ],
    'tables' => [
        'forms' => Forms::TABLE,
        'fields' => FormsFields::TABLE,
        'values' => FieldsValues::TABLE,
    ],
    'consumers' => [
    ],
];
