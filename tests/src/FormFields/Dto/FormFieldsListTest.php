<?php

namespace ByTIC\FormBuilder\Tests\FormFields\Dto;

use ByTIC\FormBuilder\FormFieldTypes\Dto\FormFieldsList;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Checkbox;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Select;
use PHPUnit\Framework\TestCase;

class FormFieldsListTest extends TestCase
{
    public function test_serialize()
    {
        $list = new FormFieldsList();
        $list->add(new Checkbox());
        $list->add(new Select());

        $serialized = serialize($list);
        $unserialized = unserialize($serialized);

        self::assertInstanceOf(FormFieldsList::class, $unserialized);
        self::assertCount(2, $unserialized->all());
    }
}
