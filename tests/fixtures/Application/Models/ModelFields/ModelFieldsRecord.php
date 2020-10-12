<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\ModelFields;

use ByTIC\Common\Records\Record;
use ByTIC\FormBuilder\Application\Models\ModelFields\Traits\ModelFieldsRecordTrait;
use ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits\ModelWithFieldsRecordTrait;

/**
 * Class ModelFieldsRecord
 * @package ByTIC\FormBuilder\Tests\Fixtures\Application\Models\ModelFields
 */
class ModelFieldsRecord extends Record
{
    use ModelFieldsRecordTrait;
}
