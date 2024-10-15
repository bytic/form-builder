<?php

namespace ByTIC\FormBuilder\FormResponseValues\Dto;

use ByTIC\FormBuilder\FormResponseValues\Models\FormResponseValue;

class FormValuesConsumerList
{
    protected $form;

    protected $consumer;

    protected $values;

    public function __construct($form, $consumer)
    {
        $this->form = $form;
        $this->consumer = $consumer;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     */
    public function setValues($values): void
    {
        $values = $values->keyBy('id_field');
        $this->values = $values;
    }

    /**
     * @param FormResponseValue $value
     * @return FormValuesConsumerList
     */
    public function add($value)
    {
        $this->values->set($value->id_field, $value);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return mixed
     */
    public function getConsumer()
    {
        return $this->consumer;
    }
}