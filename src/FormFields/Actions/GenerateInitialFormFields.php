<?php

namespace ByTIC\FormBuilder\FormFields\Actions;

use ByTIC\FormBuilder\Consumers\Actions\GetConsumerConfig;
use ByTIC\FormBuilder\Consumers\Dto\ConsumerConfig;
use ByTIC\FormBuilder\Consumers\Models\Consumer;
use ByTIC\FormBuilder\Forms\Actions\GetConsumerForForm;
use ByTIC\FormBuilder\Forms\Models\Form;
use Nip\Records\Collections\Associated;
use Nip\Records\Collections\Collection;

class GenerateInitialFormFields
{
    protected ?Form $form = null;
    protected ?Consumer $consumer = null;
    protected ?ConsumerConfig $consumerConfig = null;
    /**
     */
    protected mixed $fieldsCollection;

    /**
     * @param Collection|null $fieldsCollection
     */
    protected function __construct($form, $fieldsCollection = null)
    {
        $this->setForm($form);
        $this->fieldsCollection = $fieldsCollection ?? $this->form->getFormFields();
    }

    public function setForm(Form $form): void
    {
        $this->form = $form;
    }

    public static function forForm(Form $form, $fieldsCollection = null): static
    {
        $action = new static($form, $fieldsCollection);
        $action->setConsumer(GetConsumerForForm::for($form)->handle());

        return $action;
    }

    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
        $this->consumerConfig = GetConsumerConfig::forConsumer($consumer)->handle();
    }

    public function handle(): Associated
    {
        $this->generateFromConsumerConfig();

        return $this->fieldsCollection;
    }

    protected function generateFromConsumerConfig()
    {
        $mandatoryFields = $this->consumerConfig->getMandatoryFields();
        foreach ($mandatoryFields as $role => $names) {
            foreach ($names as $fieldType) {
                $this->fieldsCollection->add($this->generateField($fieldType));
            }
        }
    }

    protected function generateField($fieldType)
    {
        return CreateFormField::forForm($this->form, $fieldType)->handle();
    }
}