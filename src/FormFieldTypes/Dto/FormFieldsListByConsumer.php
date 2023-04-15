<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Dto;

use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use InvalidArgumentException;
use Nip\Cache\Cacheable\CanCache;
use Nip\Collections\Lazy\AbstractLazyCollection;

class FormFieldsListByConsumer extends AbstractLazyCollection
{
    use CanCache;

    /**
     * @param AbstractType $field
     * @return $this
     */
    public function addForConsumer(AbstractType $field, $consumer): self
    {
        $this->forConsumer($consumer)->add($field);

        return $this;
    }

    public function forConsumer($consumer): FormFieldsList
    {
        $this->guardConsumerList($consumer);

        return $this->get($consumer);
    }

    protected function guardConsumerList($consumer): void
    {
        $consumer = $this->consumerKey($consumer);
        if ($this->has($consumer)) {
            return;
        }

        $this->set($consumer, new FormFieldsList());
    }

    /**
     * @param $consumer
     * @return string
     */
    protected function consumerKey($consumer): string
    {
        if (is_string($consumer)) {
            return $consumer;
        }
        if (!is_object($consumer)) {
            throw new InvalidArgumentException('Consumer must be an object or a string');
        }
        if (method_exists($consumer, 'getName')) {
            return $consumer->getName();
        }

        if (method_exists($consumer, 'getTable')) {
            return $consumer->getTable();
        }

        return (string)$consumer;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($key, $value): void
    {
        $this->needsCaching(true);
        parent::offsetSet($key, $value);
    }

    public function __destruct()
    {
        $this->checkSaveCache();
    }

    protected function generateCacheData()
    {
        return $this->items;
    }

    protected function doLoad(): void
    {
        $data = $this->getDataFromCache();
        if ($data === null) {
            return;
        }
        $this->setItems($data);
    }
}