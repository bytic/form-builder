<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\Types;

use ByTIC\Common\Records\Properties\Types\Generic as GenericAbstractType;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeTrait;

/**
 * Class AbstractType
 * @package KM42\Volunteers\Models\Event_FormFields\Types\Custom
 */
abstract class AbstractType extends GenericAbstractType
{
    use AbstractTypeTrait;

}
