<?php

namespace ByTIC\FormBuilder\Base\Actions\Behaviours;

use ByTIC\FormBuilder\Consumers\Dto\ConsumerConfig;

trait HasConsumerConfig
{
    protected ?ConsumerConfig $consumerConfig = null;

    protected $consumerConfigGenerateCallback = null;

    public function getConsumerConfig(): ?ConsumerConfig
    {
        if ($this->consumerConfig === null && $this->consumerConfigGenerateCallback !== null) {
            $this->consumerConfig = call_user_func($this->consumerConfigGenerateCallback);
        }

        return $this->consumerConfig;
    }

    public function setConsumerConfig(?ConsumerConfig $consumerConfig)
    {
        $this->consumerConfig = $consumerConfig;
    }

    public function setConsumerConfigGenerateCallback(callable $consumerConfigGenerateCallback)
    {
        $this->consumerConfigGenerateCallback = $consumerConfigGenerateCallback;
    }
}
