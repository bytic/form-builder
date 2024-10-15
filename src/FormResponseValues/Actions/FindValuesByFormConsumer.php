<?php

namespace ByTIC\FormBuilder\FormResponseValues\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\FindRecords;
use ByTIC\FormBuilder\FormResponseValues\Dto\FormValuesConsumerList;

class FindValuesByFormConsumer extends Action
{
    use Behaviours\HasRepository;
    use FindRecords;

    protected ?FormValuesConsumerList $list;

    public function __construct($form, $consumer)
    {
        $this->list = new FormValuesConsumerList($form, $consumer);
    }

    public static function for($form, $consumer)
    {
        return new static($form, $consumer);
    }


    public function handle()
    {
        $values = $this->findAll();
        $this->list->setValues($values);

        return $this->list;
    }

    protected function findParams(): array
    {
        $consumer = $this->list->getConsumer();

        return [
            'id_form' => $this->list->getForm()->id,
            'consumer' => $consumer - getManager()->getMorphName(),
            'consumer_id' => $consumer->id,
        ];
    }

}
