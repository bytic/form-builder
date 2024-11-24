<?php

namespace ByTIC\FormBuilder\Tests\FormFieldTypes\Types\Custom;

use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Tel;
use Nip_Form;
use Nip_Form_Element_Tel;
use PHPUnit\Framework\TestCase;

class TelTest extends TestCase
{
    public static function data_validate()
    {
        return [
            ['', false],
            ['invalid', false],
            ['74104021', false],
            ['741040219', true],
            ['0741040219', true],
            ['+40741040219', true],
            ['0040741040219', true],
        ];
    }

    /**
     * @param $tel
     * @param $valid
     * @dataProvider data_validate
     * @return void
     */
    public function test_validate($tel, $valid)
    {
        $form = $this->generateNewInput();
        $input = $form->getElement('tel');
        $telType = new Tel();
        $telType->setFormName('tel');

        $input->setRequired(true);
        $input->setValue($tel);
        $telType->processValidation($form);
        self::assertSame($valid, !$input->isError());
    }

    protected function generateNewInput()
    {
        $form = new Nip_Form();
        $input = new Nip_Form_Element_Tel();
        $input->setName('tel');
        $input->setUniqueID('tel');
        $form->addElement($input);

        return $form;
    }

    /**
     * @return void
     */
    public function test_validate_notRequired()
    {
        $form = $this->generateNewInput();
        $input = $form->getElement('tel');
        $telType = new Tel();
        $telType->setFormName('tel');

        $telType->processValidation($form);
        self::assertFalse($input->isError());

        $input->setValue('invalid');
        $telType->processValidation($form);
        self::assertTrue($input->hasErrorByKey('invalid'));
        $input->setErrors([]);

        $input->setValue('+40741040219');
        $telType->processValidation($form);
        self::assertFalse($input->isError());
    }
}
