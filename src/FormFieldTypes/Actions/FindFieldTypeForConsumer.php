<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Actions;

use Bytic\Actions\Action;
use ByTIC\FormBuilder\Base\Actions\Behaviours\HasConsumer;
use ByTIC\FormBuilder\Base\Actions\Behaviours\HasConsumerConfig;
use ByTIC\FormBuilder\Consumers\Actions\GetConsumerConfig;
use ByTIC\FormBuilder\FormFieldTypes\Dto\FormFieldsList;
use ByTIC\FormBuilder\FormFieldTypes\Dto\FormFieldsListByConsumer;
use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use ByTIC\FormBuilder\Forms\Actions\GetConsumerForForm;

/**
 *
 */
class FindFieldTypeForConsumer extends Action
{
    protected FormFieldsListByConsumer $fieldListByConsumer;

    use HasConsumer;
    use HasConsumerConfig;

    /**
     * @param FormFieldsListByConsumer $fieldListByConsumer
     */
    public function __construct(?FormFieldsListByConsumer $fieldListByConsumer = null)
    {
        $this->fieldListByConsumer = $fieldListByConsumer ?? new FormFieldsListByConsumer();
    }

    public static function forForm($form)
    {
        $consumer = GetConsumerForForm::for($form)->handle();

        return self::forConsumer($consumer);
    }

    public function handle(): FormFieldsList
    {
        $list = $this->fieldListByConsumer->forConsumer($this->getConsumer());
        if ($list->count() > 0) {
            return $list;
        }
        $roles = $this->findFieldTypesNames();

        foreach ($roles as $role => $names) {
            if (!is_array($names)) {
                continue;
            }

            foreach ($names as $name) {
                /** @var AbstractType $type */
                $type = new $name();
                $type->setRole($role);
                $this->fieldListByConsumer->addForConsumer($type, $this->getConsumer());
            }
        }

        return $list;
    }

    public static function forConsumer($consumer, $consumerConfig = null)
    {
        $action = new static();
        $action->setConsumer($consumer);
        $action->setConsumerConfig($consumerConfig);
        $action->setConsumerGenerateCallback(function () use ($consumer) {
            return GetConsumerConfig::forConsumer($consumer)->handle();
        });

        return $action;
    }

    /**
     * @return array
     */
    protected function findFieldTypesNames()
    {
        $consumer = $this->getConsumer();
        if (method_exists($consumer, 'getFormBuilderFieldTypeAvailable')) {
            $fields = $consumer->getFormBuilderFieldTypeAvailable();

            return $fields;
        }

        return $this->getConsumerConfig()->getFields();
    }
}