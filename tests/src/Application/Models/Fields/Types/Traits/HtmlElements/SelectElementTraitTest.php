<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormField;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\Types\Select as SelectType;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Modules\AbstractModule\Forms\DynamicForm;
use Nip_Form_Element_Select as SelectElement;

/**
 * Class CheckboxTest
 * @package ByTIC\FormBuilder\Tests\Application\Models\Fields\Types
 */
class SelectElementTraitTest extends AbstractTest
{
    /**
     * @dataProvider data_initFormInput_render
     * @param $options
     * @param $dissabled
     * @param $output
     */
    public function test_initFormInput_render($options, $dissabled, $output)
    {
        $type = new SelectType();

        $item = new FormField();
        $item->setOption('select_options', $options);
        $item->setOption('select_options_disabled', $dissabled);
        $type->setItem($item);

        $form = new DynamicForm();
        $input = new SelectElement($form);

        $type->initFormInput($input);

        self::assertSame(
            $output,
            $input->renderElement());
    }

    /**
     * @return array
     */
    public function data_initFormInput_render()
    {
        return [
            [
                ['option1', 'option2', 'option3'],
                null,
                '<select  title="" ><option value="option1">option1</option><option value="option2">option2</option><option value="option3">option3</option></select>',
            ],

            [
                ['option1', 'option2', 'option3'],
                ['option2'],
                '<select  title="" ><option value="option1">option1</option><option disabled="disabled" value="option2">option2 (unavailable)</option><option value="option3">option3</option></select>',
            ]
        ];
    }
}
