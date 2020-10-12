<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\Fields\Traits;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormField;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\Types\CheckboxGroup;

/**
 * Class FormFieldTraitTest
 * @package ByTIC\FormBuilder\Tests\Application\Models\Fields\Traits
 */
class FormFieldTraitTest extends AbstractTest
{
    public function test_getType()
    {
        $field = new FormField();
        $field->type = 'checkbox_group';

        $type = $field->getType();
        self::assertInstanceOf(CheckboxGroup::class, $type);
    }

    public function test_getHelp()
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
