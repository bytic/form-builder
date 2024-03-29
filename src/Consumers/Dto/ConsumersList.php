<?php

namespace ByTIC\FormBuilder\Consumers\Dto;

class ConsumersList
{
    protected $classmap = [];

    /**
     * @var array
     */
    protected $all = [];

    public static function staticFromConfig($config): self
    {
        $list = new self();
        foreach ($config as $name => $data) {
            $config = $data instanceof ConsumerConfig ? $data : ConsumerConfig::fromConfig($data);
            $config->setName($name);
            $list->add($config);
        }

        return $list;
    }

    /**
     * @param AbstractType $field
     * @return $this
     */
    public function add(ConsumerConfig $consumerConfig): self
    {
        $this->all[$consumerConfig->getName()] = $consumerConfig;
        $this->classmap[$consumerConfig->getRepositoryClass()] = $consumerConfig;

        return $this;
    }

    /**
     * @return ConsumerConfig[]
     */
    public function all(): array
    {
        return $this->all;
    }

    public function get($name): ?ConsumerConfig
    {
        return $this->all[$name] ?? null;
    }

    public function forRepository($repositoryClass): ?ConsumerConfig
    {
        return $this->classmap[$repositoryClass] ?? null;
    }
}