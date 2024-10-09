<?php

namespace ByTIC\FormBuilder\Tests\FormFieldTypes\Types\Custom;

use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\CheckboxGroup;
use PHPUnit\Framework\TestCase;

class CheckboxGroupTest extends TestCase
{
    public function test_aliases()
    {
        $field = new CheckboxGroup();
        self::assertSame($field->getAliases(), ['custom_checkbox_group', 'CheckboxGroup']);
    }
}
