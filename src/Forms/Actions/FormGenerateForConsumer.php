<?php

namespace ByTIC\FormBuilder\Forms\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Consumers\Actions\GetConsumerType;
use ByTIC\FormBuilder\Consumers\Models\Consumer;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use Exception;
use Nip\Records\RecordManager;

/**
 *
 */
class FormGenerateForConsumer extends Action
{
    protected $unique = true;

    protected Consumer $consumer;

    protected RecordManager $formRepository;

    public function __construct($formRepository = null)
    {
        $this->formRepository = $formRepository ?? FormsBuilderModels::forms();
    }

    public static function for(Consumer $consumer)
    {
        $action = static::make();
        $action->setConsumer($consumer);

        return $action;
    }

    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
    }

    public function handle()
    {
        $consumerType = GetConsumerType::fromRecord($this->consumer);
        if ($consumerType === null) {
            throw new Exception('Consumer type not found');
        }

        $forms = $this->consumer->getFormBuilderForms();
        if ($forms->count() == 0) {
            return $this->createForm($consumerType);
        }
        if ($this->unique) {
            return $forms->first();
        }

        return $this->createForm($consumerType);
    }

    protected function createForm($consumerType)
    {
        $form = $this->formRepository->getNew();
        $form->name = 'Form '.$this->consumer->getName();
        $form->tenant_id = $this->consumer->getTenantId();
        $form->tenant = $this->consumer->getTenant();
        $form->setConsumerClass($consumerType);
        $form->save();

        $formConsumersRelation = $form->getRelation($consumerType);
        $formConsumers = $formConsumersRelation->getResults();
        $formConsumers->add($this->consumer);
        $formConsumersRelation->save();

        return $form;
    }

    protected function findConsumerType()
    {
        $consumerType = $this->consumer->getConsumerType();
        if (isset($this->consumerClasses[$consumerType])) {
            return $consumerType;
        }

        return null;
    }
}
