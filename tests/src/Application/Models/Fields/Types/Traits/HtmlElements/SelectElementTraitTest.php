<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormField;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\Types\Select as SelectType;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Modules\AbstractModule\Forms\DynamicForm;
use Mockery;
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
     * @param $output
     */
    public function test_initFormInput_render($options, $output)
    {
        $type = new SelectType();

        $item = new FormField();
        foreach ($options as $option => $value) {
            $item->setOption($option, $value);
        }
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
                ['select_options' => ['option1', 'option2', 'option3']],
                '<select  title="" class="form-select " ><option value="option1">option1</option><option value="option2">option2</option><option value="option3">option3</option></select>',
            ],
            [
                [
                    'select_options' => ['option1', 'option2', 'option3'],
                    'select_options_disabled' => ['option2'],
                ],
                '<select  title="" class="form-select " ><option value="option1">option1</option><option disabled="disabled" value="option2">option2 (unavailable)</option><option value="option3">option3</option></select>',
            ],
            [
                [
                    'select_options' => ['option1', 'option2', 'option3'],
                    'select_options_disabled' => ['option2'],
                    'hide_disabled' => 'no',
                ],
                '<select  title="" class="form-select " ><option value="option1">option1</option><option disabled="disabled" value="option2">option2 (unavailable)</option><option value="option3">option3</option></select>',
            ],
            [
                [
                    'select_options' => ['option1', 'option2', 'option3'],
                    'select_options_disabled' => ['option2'],
                    'hide_disabled' => 'yes',
                ],
                '<select  title="" class="form-select " ><option value="option1">option1</option><option value="option3">option3</option></select>',
            ]
        ];
    }

    public function test_adminGetDataFromModel()
    {
        $type = new SelectType();

        $item = new FormField();
        $type->setItem($item);

        $record = new FormField();
        $form = Mockery::mock(DynamicForm::class)->makePartial();
        $form->shouldReceive('getModel')->andReturn($record);
//        $input = new SelectElement($form);

        $type->adminGetDataFromModel($form);

        $elements = $form->getElements();
        self::assertCount(4, $elements);
    }
}
