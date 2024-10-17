<?php

namespace ByTIC\FormBuilder\Tests\FormFields\Models;

use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsField;
use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsFields;
use ByTIC\FormBuilder\Tests\Base\Models\AbstractModels\RecordTest;
use Mockery;

/**
 * Class RaceFormFieldsTest
 * @package KM42\Register\Tests\Unit\Models\Races\FormFields
 */
class RaceFormFieldTest extends RecordTest
{

    public function test_populateFromSibling()
    {
        /** @var Mockery\Mock|FormsField $field */
        $field = Mockery::mock(FormsField::class)->makePartial();
        $field->shouldReceive('getManager')->andReturn(new FormsFields());

        $field->fill(
            [
                'role' => 'competitor',
                'label' => 'label 0',
                'label_intern' => 'label_intern 0',
                'help' => 'help 0',
                'options' => 'a:0:{}',
                'type' => 'custom-text',
                'listing' => 'listing 0',
                'visible' => 'visible 0',
                'mandatory' => 'mandatory 0',
                'filter' => 'filter 0',
                'pos' => 0,
            ]
        );

        $newField = new FormsField();
        $newField->populateFromSibling($field);
        $arrayData = $newField->toArray();

        foreach (
            [
                'role',
                'label',
                'label_intern',
                'help',
                'options',
                'type',
                'listing',
                'visible',
                'mandatory',
                'filter',
                'pos',
            ] as $col) {
            self::assertSame($newField->getPropertyRaw($col), $field->getPropertyRaw($col));
            self::assertSame($arrayData[$col], $field->getPropertyRaw($col));
        }
    }
}
