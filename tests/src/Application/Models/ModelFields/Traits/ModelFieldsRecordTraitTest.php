<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\ModelFields\Traits;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\ModelFields\ModelFieldsRecord;

/**
 * Class ModelFieldsRecordTraitTest
 * @package ByTIC\FormBuilder\Tests\Application\Models\ModelFields\Traits
 */
class ModelFieldsRecordTraitTest extends AbstractTest
{
    public function test_getValue()
    {
        $field  = new ModelFieldsRecord();
        $field->writeData(['value' => 'test']);

        self::assertSame('test', $field->getValue());
    }
}