<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\Fields\Traits;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormFields;

/**
 * Class FormFieldsTraitTest.
 */
class FormFieldsTraitTest extends AbstractTest
{
    public function testGetTypesByRole()
    {
        $fields = FormFields::instance();
        $types = $fields->getTypesByRole('custom');

        self::assertIsArray($types);
        self::assertCount(8, $types);
        self::assertArrayHasKey('custom-select', $types);
    }
}
