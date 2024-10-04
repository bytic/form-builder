<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields\Behaviours\HasTypes;

use ByTIC\FormBuilder\FormFieldTypes\Actions\FindFieldTypeForConsumer;
use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordTrait as HasTypesTrait;
use Exception;

trait HasTypesRecordTrait
{
    use HasTypesTrait {
        getNewSmartPropertyFromValue as getNewSmartPropertyFromValueTrait;
    }

    public function getNewSmartPropertyFromValue($name, $value)
    {
        if ($name == 'Type' && !empty($this->id_form)) {
            $listTypes = FindFieldTypeForConsumer::forForm($this->getFormBuilder())->handle();
            $object = $listTypes->get($value);
            if ($object === null) {
                throw new Exception(
                    'Field type not found: '.$name.' - '.$value
                    .'. Available classes: '.implode(', ', array_keys($listTypes->all()))
                    .'. Available names: '.implode(', ', array_keys($listTypes->classmap()))
                );
            }
            $object->setItem($this);

            return $object;
        }

        return $this->getNewSmartPropertyFromValueTrait($name, $value);
    }
}
