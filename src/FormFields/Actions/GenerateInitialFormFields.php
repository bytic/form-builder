<?php

namespace ByTIC\FormBuilder\FormFields\Actions;

use ByTIC\FormBuilder\Base\Actions\Behaviours\HasConsumer;
use ByTIC\FormBuilder\Base\Actions\Behaviours\HasConsumerConfig;
use ByTIC\FormBuilder\Base\Actions\Behaviours\HasForm;
use ByTIC\FormBuilder\Consumers\Actions\GetConsumerConfig;
use ByTIC\FormBuilder\Forms\Actions\GetConsumerForForm;
use ByTIC\FormBuilder\Forms\Models\Form;
use Nip\Records\Collections\Associated;
use Nip\Records\Collections\Collection;

class GenerateInitialFormFields
{

    use HasForm;
    use HasConsumer;
    use HasConsumerConfig;

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

    public static function forForm(Form $form, $fieldsCollection = null): static
    {
        $action = new static($form, $fieldsCollection);
        $action->setConsumer(GetConsumerForForm::for($form)->handle());
        $action->setConsumerConfigGenerateCallback(function () use ($action) {
            return GetConsumerConfig::forConsumer($action->getConsumer())->handle();
        });

        return $action;
    }

    public function handle(): Associated
    {
        $this->generateFromConsumerConfig();

        return $this->fieldsCollection;
    }

    protected function generateFromConsumerConfig()
    {
        $mandatoryFields = $this->getConsumerConfig()->getMandatoryFields();

        if (is_array($mandatoryFields) && is_callable($mandatoryFields)) {
            $mandatoryFields = $mandatoryFields($this->getConsumer());
        }

        foreach ($mandatoryFields as $role => $names) {
            foreach ($names as $fieldType) {
                $this->fieldsCollection->add(
                    $this->generateField($fieldType, $role),
                );
            }
        }
    }

    protected function generateField($fieldType, $role = null)
    {
        return CreateFormField::forForm($this->getForm(), $fieldType)
            ->setRole($role)
            ->handle();
    }
}