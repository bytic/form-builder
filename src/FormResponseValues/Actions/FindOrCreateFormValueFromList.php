<?php

namespace ByTIC\FormBuilder\FormResponseValues\Actions;

use ByTIC\FormBuilder\FormResponseValues\Dto\FormValuesConsumerList;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;

class FindOrCreateFormValueFromList
{
    protected $list;

    public static function for(FormValuesConsumerList $list)
    {
        $action = new static();
        $action->list = $list;

        return $action;
    }

    public function fieldValue($field)
    {
        $value = $this->list->getValues()->get($field->id);
        if ($value) {
            return $value;
        }

        return $this->createValue($field);
    }

    protected function createValue($field)
    {
        $value = FormsBuilderModels::values()->getNew();
        $value->id_field = $field->id;
        $value->id_form = $this->list->getForm()->id;

        $consumer = $this->list->getConsumer();
        $value->consumer = $consumer->getManager()->getMorphName();
        $value->consumer_id = $consumer->id;

        $this->list->add($value);

        return $value;
    }
}