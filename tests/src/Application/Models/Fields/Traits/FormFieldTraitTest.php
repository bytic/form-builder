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

    public function testGetType()
    {
        $field = new FormField();
        $field->type = 'checkbox_group';

        $type = $field->getType();
        self::assertInstanceOf(CheckboxGroup::class, $type);
    }
}
