<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\Fields\Types;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormField;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\Types\Checkbox as CheckboxType;
use Nip_Form_Element_Checkbox as CheckboxElement;
use Nip_Form_Model;

/**
 * Class CheckboxTest.
 */
class CheckboxTest extends AbstractTest
{
    /**
     * @dataProvider data_init_form_input_label_decode
     */
    public function testInitFormInputLabelDecode($label_in, $label_out, $title)
    {
        $type = new CheckboxType();
        $item = new FormField();
        $type->setItem($item);

        $form = new Nip_Form_Model();
        $input = new CheckboxElement($form);
        $input->setLabel($label_in);

        $type->initFormInput($input);

        self::assertSame($label_out, $input->getLabel());
        self::assertSame($title, $input->getAttrib('title'));
    }

    /**
     * @return array
     */
    public function data_init_form_input_label_decode()
    {
        return [
            [
                'Size (&lt;a href=&quot;https://domain.ro/&quot; target=&quot;_blank&quot;&gt;Size&lt;/a&gt;)',
                'Size (<a href="https://domain.ro/" target="_blank">Size</a>)',
                'Size (Size)',
            ],
        ];
    }
}
