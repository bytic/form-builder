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

    protected static array $lists = [];

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
        $cacheKey = $this->cacheKey();
        if (isset(static::$lists[$cacheKey])) {
            $this->list = static::$lists[$cacheKey];
        } else {
            $this->populateList();
            static::$lists[$cacheKey] = $this->list;
        }

        return $this->list;
    }

    protected function populateList()
    {
        $values = $this->findAll();
        $this->list->setValues($values);
    }

    protected function findParams(): array
    {
        $consumer = $this->list->getConsumer();

        return [
            'where' => [
                ['id_form = ?', $this->list->getForm()->id,],
                ['consumer = ?', $consumer->getManager()->getMorphName(),],
                ['consumer_id = ?', $consumer->id,],
            ],
        ];
    }

    protected function cacheKey(): string
    {
        return base64_encode(serialize($this->findParams()));
    }

}
