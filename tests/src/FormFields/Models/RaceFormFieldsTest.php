<?php

namespace ByTIC\FormBuilder\Tests\FormFields\Models;


use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsFields;
use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use ByTIC\FormBuilder\Tests\Base\Models\AbstractModels\RecordsTest;

/**
 * Class RaceFormFieldsTest
 * @package KM42\Register\Tests\Unit\Models\Races\FormFields
 */
class RaceFormFieldsTest extends RecordsTest
{
    public function test_get_types()
    {
        $manager = new FormsFields();
        $types = $manager->getTypes();

//        self::assertCount(26, $types);

        $typesCheck = [
            'custom_checkbox',
            'custom_checkbox_group',
            'custom_radio_group',
            'custom_select',
            'custom_text',
            'custom_textarea',
            'custom_timeselect',
        ];

        foreach ($typesCheck as $type) {
            $type = $manager->getType($type);
            self::assertInstanceOf(AbstractType::class, $type);
//            $types = FormsFields::instance()->getTypes();
//            self::assertArrayHasKey($type, $types);
        }
    }
}
