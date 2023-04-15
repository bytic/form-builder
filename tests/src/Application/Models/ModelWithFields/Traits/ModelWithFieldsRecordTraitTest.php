<?php

namespace ByTIC\FormBuilder\Tests\Application\Models\ModelWithFields\Traits;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormFields;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\ModelWithFields\ModelWithFieldsRecord;
use Mockery;
use Nip\Collections\Collection;
use Nip\Records\Relations\HasMany;

/**
 * Class ModelWithFieldsRecordTraitTest.
 */
class ModelWithFieldsRecordTraitTest extends AbstractTest
{
    public function testGetFormFieldsWithRecord()
    {
        $model = Mockery::mock(ModelWithFieldsRecord::class)->makePartial();
        $model->shouldAllowMockingProtectedMethods();

        $relation = new HasMany();
        $relation->setItem($model);
        $relation->setResults(new Collection([1]));
        $relation->setWith(FormFields::instance());

        $model->shouldReceive('getFormFieldsRelation')->andReturn($relation);

        $fields = $model->getFormFields();

        self::assertCount(1, $fields);
    }

//    public function testInitDefaultFormFields()
//    {
//        /** @var ModelWithFieldsRecord|Mock $model */
//        $model = \Mockery::mock(ModelWithFieldsRecord::class)->makePartial();
//        $model->shouldAllowMockingProtectedMethods();
//        $model->shouldReceive('isInDB')->andReturn(false);
//
//        $relation = new HasMany();
//        $relation->setItem($model);
//
//        $collection = \Mockery::mock(Collection::class)->makePartial();
//        $collection->shouldReceive('getRecordKey')->andReturn(null);
//        $relation->setResults($collection);
//
//        $field = \Mockery::mock(FormField::class)->makePartial();
//        $field->shouldReceive('populateFromParent')->twice();
//        $field->shouldReceive('populateFromType')->twice();
//        $field->shouldReceive('insert')->once();
//
//        $fieldsManager = \Mockery::mock(FormFields::class)->makePartial();
//        $fieldsManager->shouldReceive('getNew')->andReturn(clone $field);
//
//        $relation->setWith($fieldsManager);
//
//        $model->shouldReceive('getFormFieldsRelation')->andReturn($relation);
//
//        $fields = $model->getFormFields();
//
//        self::assertCount(2, $fields);
//    }
}
