<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields\Behaviours\HasTypes;

use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordsTrait as HasTypesTrait;

trait HasTypesRecordsTrait
{
    use HasTypesTrait;

    public function getTypeItemsDirectory(): array
    {
        return [
            'ByTIC\FormBuilder\FormFieldTypes\Types' => AbstractType::TYPES_DIR,
        ];
    }
}
