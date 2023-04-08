<?php

namespace ByTIC\FormBuilder\Consumers\Dto;

/**
 *
 */
class ConsumerConfig
{
    protected $name;

    protected $repositoryClass;

    protected $roles = [];

    public static function fromConfig($config): self
    {
        $consumer = new self();
        $consumer->populateFromConfig($config);

        return $consumer;
    }

    public function populateFromConfig($config): self
    {
        if (is_string($config)) {
            $config = ['repository' => $config];
        }
        $this->setName($config['name'] ?? null);
        $this->setRepositoryClass($config['repository'] ?? null);
        $this->setRoles($config['roles'] ?? []);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRepositoryClass()
    {
        return $this->repositoryClass;
    }

    /**
     * @param mixed $repositoryClass
     */
    public function setRepositoryClass($repositoryClass): void
    {
        $this->repositoryClass = $repositoryClass;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }
}