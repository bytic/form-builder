<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use ByTIC\FormBuilder\Application\Models\Form\Traits\HasFieldsRecordTrait;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner;
use Nip\Form\FormModel as NipModelForm;
use Nip\Records\Record;

/**
 * Trait AbstractTypeInterfaceTrait.
 */
trait AbstractTypeInterfaceTrait
{
    protected $inputType = 'input';

    protected $inputRole = FormFieldsDesigner::ROLE_CUSTOM;

    protected $canDelete = true;

    protected $modelValues = [];

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @param bool $short
     *
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
     *
     * @return mixed
     */
    abstract public function getFormValue($form, $requester = 'model');

    /**
     * @param string $value
     *
     * @return self
     */
    abstract public function setInputType($value);

    /**
     * @param string $value
     *
     * @return self
     */
    abstract public function setRole($value);

    abstract public function setCanDelete(bool $canDelete);

    /**
     * @param NipModelForm $form
     *
     * @return Record|HasFieldsRecordTrait
     */
    abstract protected function getModelFromForm($form);
}
