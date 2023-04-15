<?php

namespace ByTIC\FormBuilder\Tests\FormFields\Dto;

use ByTIC\FormBuilder\FormFieldTypes\Dto\FormFieldsList;
use ByTIC\FormBuilder\FormFieldTypes\Dto\FormFieldsListByConsumer;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Checkbox;
use PHPUnit\Framework\TestCase;

class FormFieldsListByConsumerTest extends TestCase
{

    public function test_save_to_cache()
    {
        $list = new FormFieldsListByConsumer();

        $type = new Checkbox();
        $list->addForConsumer($type, 'consumer');
        unset($list);

        $list = new FormFieldsListByConsumer();

        $consumerList = $list->forConsumer('consumer');
        self::assertInstanceOf(FormFieldsList::class, $consumerList);
        self::assertCount(1, $consumerList->all());
    }
}
