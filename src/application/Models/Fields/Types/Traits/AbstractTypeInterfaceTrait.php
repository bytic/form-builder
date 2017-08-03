<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use ByTIC\FormBuilder\Application\Models\Form\Traits\HasFieldsRecordTrait;
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
     * @param bool $short
     * @return string
     */
    abstract public function getLabel($short = false);

    /**
     * @return Record|FormFieldTrait
     */
    abstract public function getItem();

    /**
     * @param $form
     * @param string $requester
     * @return mixed
     */
    abstract public function getFormValue($form, $requester = 'model');

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
     * @return Record|HasFieldsRecordTrait
     */
    abstract protected function getModelFromForm($form);
}
