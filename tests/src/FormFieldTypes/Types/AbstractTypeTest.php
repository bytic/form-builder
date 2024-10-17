<?php

namespace ByTIC\FormBuilder\Tests\FormFieldTypes\Types;

use ByTIC\FormBuilder\Tests\AbstractTest;
use Mockery;
use Nip\Form\FormModel;

abstract class AbstractTypeTest extends AbstractTest
{
    protected function generateFormMock()
    {
        $form = Mockery::mock(FormModel::class)
            ->makePartial();

        $form->shouldReceive('getModelForRole')->andReturnUsing(function ($role) use ($form) {
            return $form->getModel();
        });

        return $form;
    }
}