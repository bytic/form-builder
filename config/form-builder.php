<?php

use ByTIC\FormBuilder\Models\FormsFields\FormsFields;
use ByTIC\FormBuilder\Models\Forms\Forms;
use ByTIC\FormBuilder\Models\FieldsValues\FieldsValues;
use ByTIC\FormBuilder\Utility\PathsHelpers;

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
    'fields' => [
        'discovery' => [
            'paths' => [
                'form-builder' => [
                    'namespace' => 'ByTIC\FormBuilder\Fields',
                    'path' => PathsHelpers::basePath().'/src/FormFields/Types',
                ],
            ],
        ],
        'classmap' => [],
    ],
];
