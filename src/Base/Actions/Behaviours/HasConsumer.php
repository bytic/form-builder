<?php

namespace ByTIC\FormBuilder\Base\Actions\Behaviours;

use ByTIC\FormBuilder\Consumers\Models\Consumer;

/**
 *
 */
trait HasConsumer
{
    protected ?Consumer $consumer = null;

    /**
     * @var null|callable
     */
    protected $consumerGenerateCallback = null;

    public function getConsumer(): ?Consumer
    {
        if ($this->consumer === null && $this->consumerGenerateCallback !== null) {
            $this->consumer = call_user_func($this->consumerGenerateCallback);
        }

        return $this->consumer;
    }

    public function setConsumer(?Consumer $consumer): void
    {
        $this->consumer = $consumer;
    }

    public function setConsumerGenerateCallback(callable $consumerGenerateCallback)
    {
        $this->consumerGenerateCallback = $consumerGenerateCallback;
    }
}

