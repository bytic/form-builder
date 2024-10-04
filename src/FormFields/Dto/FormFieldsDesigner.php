<?php

namespace ByTIC\FormBuilder\FormFields\Dto;

use ByTIC\FormBuilder\FormFields\Models\FormFields\FormsField;
use ByTIC\FormBuilder\FormFieldTypes\Dto\FormFieldsList;
use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Checkbox;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\CheckboxGroup;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\RadioGroup;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Select;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Text;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Textarea;
use ByTIC\FormBuilder\FormFieldTypes\Types\Custom\Timeselect;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Collections\Collection;

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

    protected $roles = [];

    public function __construct()
    {
    }

    /**
     * @param $role
     * @return array|mixed
     */
    public function getExisting($role)
    {
        return $this->existing[$role] ?? new FormFieldsList();
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
        return is_array($this->roles) && count($this->roles) ? $this->roles : [self::ROLE_DEFAULT];
    }

    /**
     * @param array $roles
     */
    public function setRoles(?array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @param $role
     * @return $this
     */
    public function addRole($role): self
    {
        if (in_array($role, $this->roles)) {
            return $this;
        }
        $this->roles[] = $role;
        $this->roles = array_unique($this->roles);

        return $this;
    }

    protected function guardAvailable($role)
    {
        if (!isset($this->available[$role])) {
            $this->addRole($role);
            $this->available[$role] = new FormFieldsList();
        }
    }

    /**
     * @param Record|FormsField $field
     * @param $role
     * @return void
     */
    public function addExisting(Record $field, $role = null): void
    {
        $role = $role ?? $field->getRole();
        $role = $role ?? self::ROLE_DEFAULT;

        /** @var AbstractType $type */
        $type = $field->getType();
        if ($type->isUnique()) {
            $this->getAvailable($role)->remove($type);
        }
        $this->guardExisting($role);
        $this->existing[$role]->add($field);
    }


    protected function guardExisting($role)
    {
        if (!isset($this->existing[$role])) {
            $this->addRole($role);
            $this->existing[$role] = new Collection();
        }
    }

}