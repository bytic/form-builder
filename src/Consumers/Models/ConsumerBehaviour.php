<?php

namespace ByTIC\FormBuilder\Consumers\Models;

use Nip\Records\Record;

/**
 *
 */
trait ConsumerBehaviour
{
    /**
     * @return null|int
     */
    public function getTenantId(): ?int
    {
        $record = $this->getTenantRecord();
        if (false == is_object($record)) {
            return null;
        }

        return $record->id;
    }

    public function getTenantRecord(): ?Record
    {
        return null;
    }

    public function getTenant(): ?string
    {
        $record = $this->getTenantRecord();
        if (false == is_object($record)) {
            return null;
        }

        return $record->getManager()->getMorphName();
    }

    public function getFormBuilderForms()
    {
        return $this->getRelation('FormBuilderForms')->getResults();
    }
}