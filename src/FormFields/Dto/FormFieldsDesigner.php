<?php

namespace ByTIC\FormBuilder\FormFields\Dto;

use ByTIC\FormBuilder\FormFields\Types\AbstractType;
use ByTIC\FormBuilder\FormFields\Types\Custom\Checkbox;
use ByTIC\FormBuilder\FormFields\Types\Custom\CheckboxGroup;
use ByTIC\FormBuilder\FormFields\Types\Custom\RadioGroup;
use ByTIC\FormBuilder\FormFields\Types\Custom\Select;
use ByTIC\FormBuilder\FormFields\Types\Custom\Text;
use ByTIC\FormBuilder\FormFields\Types\Custom\Textarea;
use ByTIC\FormBuilder\FormFields\Types\Custom\Timeselect;

class FormFieldsDesigner
{

    public const ROLE_DEFAULT = 'default';
    public const ROLE_CUSTOM = 'custom';

    public const FIELDS_CUSTOM = [
        Text::class,
        Textarea::class,
        Select::class,
        Checkbox::class,
        CheckboxGroup::class,
        RadioGroup::class,
        Timeselect::class,
    ];
    /**
     * @var FormFieldsList[]
     */
    protected $existing = [];

    /**
     * @var FormFieldsList[]
     */
    protected $available = [];

    /**
     * @var FormFieldsList[]
     */
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

    public function getAvailable($role): FormFieldsList
    {
        $this->guardAvailable($role);

        return $this->available[$role];
    }

    public function addAvailable(AbstractType $field, $role = null): self
    {
        $role = $role ?? $field->getRole();
        $role = $role ?? self::ROLE_DEFAULT;
        $this->guardAvailable($role);
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

    protected function guardAvailable($role)
    {
        if (!isset($this->available[$role])) {
            $this->available[$role] = new FormFieldsList();
        }
    }
}