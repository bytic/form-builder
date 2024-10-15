<?php

use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsFields;
use ByTIC\FormBuilder\FormResponseValues\Models\FormResponseValues;
use ByTIC\FormBuilder\Forms\Models\Forms;
use ByTIC\FormBuilder\Utility\PathsHelpers;

return [
    'models' => [
        'forms' => Forms::class,
        'fields' => FormsFields::class,
        'values' => FormResponseValues::class,
    ],
    'tables' => [
        'forms' => Forms::TABLE,
        'fields' => FormsFields::TABLE,
        'values' => FormResponseValues::TABLE,
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
