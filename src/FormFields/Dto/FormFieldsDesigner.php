<?php

namespace ByTIC\FormBuilder\FormFields\Dto;

use ByTIC\FormBuilder\FormFields\Types\AbstractType;

class FormFieldsDesigner
{

    public const ROLE_DEFAULT = 'default';

    protected $existing = [];

    protected FormFieldsList $available;

    protected $custom = [];

    protected $roles = null;

    public function __construct()
    {
    }

    /**
     * @param $role
     * @return array|mixed
     */
    public function getExisting($role)
    {
        return $this->existing[$role] ?? [];
    }

    public function getAvailable($role): array
    {
        return $this->available[$role] ?? [];
    }

    public function addAvailable(AbstractType $field, $role = null): self
    {
        $role = $role ?? $field->getRole();
        if (!isset($this->available[$role])) {
            $this->available[$role] = new FormFieldsList();
        }
        $this->available[$role]->add($field);

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles ?? [self::ROLE_DEFAULT];
    }

    /**
     * @param array $roles
     */
    public function setRoles(?array $roles): void
    {
        $this->roles = $roles;
    }
}