<?php

namespace ByTIC\FormBuilder\Tests\FormFieldTypes\Types;

use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormField;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\Types\CheckboxGroup as CheckboxGroupType;
use Nip\Records\Record;
use Nip_Form_Element_Checkbox;
use Nip_Form_Element_CheckboxGroup as CheckboxGroupElement;

/**
 * Class CheckboxGroupTest.
 */
class CheckboxGroupTest extends AbstractTypeTest
{
    public function testInitFormInput()
    {
        $type = new CheckboxGroupType();

        $options = [
            'Test 1',
            'Test 2',
            'Test 3',
        ];
        $item = new FormField();
        $item->setOption('check_options', $options);
        $type->setItem($item);

        $form = $this->generateFormMock();
        $input = new CheckboxGroupElement($form);

        $type->initFormInput($input);

        self::assertInstanceOf(Nip_Form_Element_Checkbox::class, $input->getElement('Test 1'));
    }

    public function testPrintItemValue()
    {
        $type = new CheckboxGroupType();

        $values = ['VAL1', 'VAL2'];
        $model = new Record();
        $model->checkbox_group = serialize($values);

        self::assertSame(implode(', ', $values), $type->printItemValue($model));
    }
}
