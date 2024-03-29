<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeTrait;
use ByTIC\Models\SmartProperties\Properties\Types\Generic;

/**
 * Class AbstractType
 */
abstract class AbstractType extends Generic
{
    public const TYPES_DIR = __DIR__;

    use AbstractTypeTrait;
}
