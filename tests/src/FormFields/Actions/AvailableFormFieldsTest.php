<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\FormFields\Actions;

use ByTIC\FormBuilder\FormFields\Actions\GenerateFormFieldsDesigner;
use ByTIC\FormBuilder\Models\Forms\Form;
use ByTIC\FormBuilder\Tests\AbstractTest;

class AvailableFormFieldsTest extends AbstractTest
{

    public function test_getAvailableTypes()
    {
        $consumer =
        $form = new Form();
        $list = GenerateFormFieldsDesigner::forForm($form)
            ->handle();
        self::assertInstanceOf(
            \ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner::class,
            $list
        );
    }
}
