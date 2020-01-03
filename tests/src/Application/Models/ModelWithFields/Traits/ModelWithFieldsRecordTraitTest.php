<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\ModelWithFields\Traits;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormField;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormFields;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\ModelWithFields\ModelWithFieldsRecord;
use Mockery\Mock;
use Nip\Collections\Collection;
use Nip\Records\Relations\HasMany;

/**
 * Class ModelWithFieldsRecordTraitTest
 * @package ByTIC\FormBuilder\Tests\Application\Models\ModelWithFields\Traits
 */
class ModelWithFieldsRecordTraitTest extends AbstractTest
{
    public function testGetFormFieldsWithRecord()
    {
        $model = \Mockery::mock(ModelWithFieldsRecord::class)->makePartial();
        $model->shouldAllowMockingProtectedMethods();

        $relation = new HasMany();
        $relation->setItem($model);
        $relation->setResults(new Collection([1]));
        $relation->setWith(FormFields::instance());

        $model->shouldReceive('getFormFieldsRelation')->andReturn($relation);

        $fields = $model->getFormFields();

        self::assertCount(1, $fields);
    }

    public function testInitDefaultFormFields()
    {
        /** @var ModelWithFieldsRecord|Mock $model */
        $model = \Mockery::mock(ModelWithFieldsRecord::class)->makePartial();
        $model->shouldAllowMockingProtectedMethods();
        $model->shouldReceive('isInDB')->andReturn(false);

        $relation = new HasMany();
        $relation->setItem($model);

        $collection = \Mockery::mock(Collection::class)->makePartial();
        $collection->shouldReceive('getRecordKey')->andReturn(null);
        $relation->setResults($collection);

        $field = \Mockery::mock(FormField::class)->makePartial();
        $field->shouldReceive('populateFromParent')->once();
        $field->shouldReceive('populateFromType')->once();
        $field->shouldReceive('insert')->once();

        $fieldsManager = \Mockery::mock(FormFields::class)->makePartial();
        $fieldsManager->shouldReceive('getNew')->andReturn(clone $field);

        $relation->setWith($fieldsManager);

        $model->shouldReceive('getFormFieldsRelation')->andReturn($relation);

        $fields = $model->getFormFields();

        self::assertCount(2, $fields);
    }
}
