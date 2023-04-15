<?php

use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsFields;
use ByTIC\FormBuilder\Forms\Models\Forms;
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
