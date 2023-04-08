<?php

namespace ByTIC\FormBuilder\Consumers\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Consumers\Dto\ConsumerConfig;
use ByTIC\FormBuilder\Utility\PackageConfig;
use Exception;

class GetConsumerConfig extends Action
{

    protected $consumer;

    /**
     * @param $consumer
     */
    public function __construct($consumer)
    {
        $this->consumer = $consumer;
    }

    /**
     * @param $consumer
     * @return self
     */
    public static function forConsumer($consumer): self
    {
        $action = new static($consumer);

        return $action;
    }

    public function handle(): ?ConsumerConfig
    {
        $consumerType = GetConsumerType::fromRecord($this->consumer);
        if ($consumerType === null) {
            throw new Exception('Consumer type not found');
        }

        $config = PackageConfig::consumersList()->get($consumerType);
        if ($config === null) {
            throw new Exception('Consumer config not found');
        }

        return $config;
    }
}