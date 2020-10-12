<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\Fields\Traits;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormFields;

/**
 * Class FormFieldsTraitTest
 * @package ByTIC\FormBuilder\Tests\Application\Models\Fields\Traits
 */
class FormFieldsTraitTest extends AbstractTest
{
    public function test_getTypesByRole()
    {
        $fields = FormFields::instance();
        $types = $fields->getTypesByRole('custom');

        self::assertIsArray($types);
        self::assertCount(3, $types);
        self::assertArrayHasKey('select', $types);
    }
}
