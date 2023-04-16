<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\Fields\Traits;

use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\CheckboxGroup;
use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormField;

/**
 * Class FormFieldTraitTest.
 */
class FormFieldTraitTest extends AbstractTest
{
    public function testGetType()
    {
        $field = new FormField();
        $field->type = 'custom-checkbox_group';

        $type = $field->getType();
        self::assertInstanceOf(CheckboxGroup::class, $type);
    }

    public function testGetHelp()
    {
        $field = new FormField();
        $field->writeData(['help' => '']);
        self::assertSame('', $field->help);
        self::assertSame('', $field->getHelp());

        $field = new FormField();
        $field->writeData(['help' => 'test']);
        self::assertSame('test', $field->help);
        self::assertSame('test', $field->getHelp());
    }
}
