<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use Nip\Records\Record;
use Nip_Form_Model as NipModelForm;

/**
 * Trait AbstractTypeInterfaceTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits
 *
 * Trait used to overload methods so type hinting works
 */
trait AbstractTypeInterfaceTrait
{
    protected $inputType = 'input';

    protected $inputRole = 'custom';

    protected $canDelete = true;

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return string
     */
    abstract public function getLabel();

    /**
     * @return Record|FormFieldTrait
     */
    abstract public function getItem();

    /**
     * @param string $value
     * @return self
     */
    abstract public function setInputType($value);

    /**
     * @param string $value
     * @return self
     */
    abstract public function setRole($value);

    /**
     * @param bool $canDelete
     */
    abstract public function setCanDelete(bool $canDelete);

    /**
     * @param NipModelForm $form
     * @return Record
     */
    abstract protected function getModelFromForm($form);
}