<?php

namespace ByTIC\FormBuilder\Tests\FormFields\Actions;

use ByTIC\FormBuilder\Consumers\Dto\ConsumerConfig;
use ByTIC\FormBuilder\Consumers\Models\Consumer;
use ByTIC\FormBuilder\FormFields\Actions\GenerateFormFieldsDesigner;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner;
use ByTIC\FormBuilder\Forms\Models\Form;
use ByTIC\FormBuilder\Tests\AbstractTest;
use Mockery;

class AvailableFormFieldsTest extends AbstractTest
{

    public function test_getAvailableTypes()
    {
        $form = new Form();
        $form->get('metadata')->set('consumer_class', 'Donation');

        $form = Mockery::mock($form)->makePartial();
        $existingFields = Mockery::mock(Collection::class)->makePartial();
        $existingFields->shouldReceive('count')->andReturn(1);
        $form->shouldReceive('getFormFields')->andReturn($existingFields);

        $action = GenerateFormFieldsDesigner::forForm($form);
        $action->setConsumerConfig(new ConsumerConfig());

        $consumer = Mockery::mock(Consumer::class)->makePartial();
        $action->setConsumer($consumer);

        $actionMock = Mockery::mock($action)->makePartial();
        $list = $actionMock->handle();

        self::assertInstanceOf(
            FormFieldsDesigner::class,
            $list
        );
    }
}
