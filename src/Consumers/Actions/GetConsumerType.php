<?php

namespace ByTIC\FormBuilder\Consumers\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Consumers\Dto\ConsumersList;
use ByTIC\FormBuilder\Consumers\Models\Consumer;
use ByTIC\FormBuilder\Utility\PackageConfig;
use Nip\Records\Record;

/**
 *
 */
class GetConsumerType extends Action
{
    protected ConsumersList $consumerClasses;

    /**
     * @param $consumerClasses
     */
    public function __construct($consumerClasses = null)
    {
        $this->consumerClasses = $consumerClasses ?? PackageConfig::consumersList();
    }

    /**
     * @param Consumer|Record $consumer
     * @return int|string|null
     */
    public static function fromRecord(Consumer $consumer): int|string|null
    {
        $action = static::make();

        return $action->handle($consumer->getManagerName());
    }

    public function handle($consumerClassRepository = null): int|string|null
    {
        return $this->consumerClasses->forRepository($consumerClassRepository)?->getName();
    }
}