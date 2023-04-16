<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields\Behaviours\HasTypes;

use ByTIC\FormBuilder\FormFieldTypes\Actions\FindFieldTypeForConsumer;
use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordTrait as HasTypesTrait;

trait HasTypesRecordTrait
{
    use HasTypesTrait {
        getNewSmartPropertyFromValue as getNewSmartPropertyFromValueTrait;
    }

    public function getNewSmartPropertyFromValue($name, $value)
    {
        if ($name == 'type' && !empty($this->id_form)) {
            $listTypes = FindFieldTypeForConsumer::forForm($this->getFormBuilder())->handle();
            $object = $listTypes->get($value);
            $object->setItem($this);

            return $object;
        }

        return $this->getNewSmartPropertyFromValueTrait($name, $value);
    }
}
