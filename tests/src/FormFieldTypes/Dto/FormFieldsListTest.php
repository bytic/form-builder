<?php

namespace ByTIC\FormBuilder\Tests\FormFieldTypes\Dto;

use ByTIC\FormBuilder\FormFieldTypes\Dto\FormFieldsList;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\RadioGroup;
use PHPUnit\Framework\TestCase;

class FormFieldsListTest extends TestCase
{
    public function test_type_alias()
    {
        $list = new FormFieldsList();

        $radioGroup = new RadioGroup();
        $list->add($radioGroup);
        self::assertSame($list->get('radio_group'), $radioGroup);
        self::assertSame($list->get('custom_radio_group'), $radioGroup);
    }
}
