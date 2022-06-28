<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\ModelWithFields;

use ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits\ModelWithFieldsRecordTrait;
use Nip\Records\Record;

/**
 * Class FormField.
 */
class ModelWithFieldsRecord extends Record
{
    use ModelWithFieldsRecordTrait;

    /** @noinspection PhpMissingParentCallCommonInspection
     * {@inheritDoc}
     */
    protected function inflectManagerName()
    {
        return ModelWithFieldsRecords::class;
    }

    /**
     * @return array
     */
    public function generateDefaultFormFieldsTypes()
    {
        return ['checkbox', 'select'];
    }
}
