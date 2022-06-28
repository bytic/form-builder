<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\Types;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeTrait;
use ByTIC\Models\SmartProperties\Properties\Types\Generic as GenericAbstractType;

/**
 * Class AbstractType.
 */
abstract class AbstractType extends GenericAbstractType
{
    use AbstractTypeTrait;
}
