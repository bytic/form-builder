<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\Types;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeTrait;
use ByTIC\Models\SmartProperties\Properties\Types\Generic as GenericAbstractType;

/**
 * Class AbstractType.
 */
abstract class AbstractType extends GenericAbstractType
{
    use AbstractTypeTrait;
}
