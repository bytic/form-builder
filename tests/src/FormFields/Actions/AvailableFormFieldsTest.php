<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\FormFields\Actions;

use ByTIC\FormBuilder\FormFields\Actions\GenerateFormFieldsDesigner;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner;
use ByTIC\FormBuilder\Forms\Models\Form;
use ByTIC\FormBuilder\Tests\AbstractTest;

class AvailableFormFieldsTest extends AbstractTest
{

    public function test_getAvailableTypes()
    {
        $form = new Form();
        $list = GenerateFormFieldsDesigner::forForm($form)
            ->handle();
        self::assertInstanceOf(
            FormFieldsDesigner::class,
            $list
        );
    }
}
