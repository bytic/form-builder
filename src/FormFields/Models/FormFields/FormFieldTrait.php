<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields;

use ByTIC\Common\Records\Record;
use ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits\ModelWithFieldsRecordTrait;
use ByTIC\FormBuilder\FormFields\Types\Behaviours\AbstractTypeTrait;
use ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordTrait;
use ByTIC\Records\Behaviors\HasSerializedOptions\HasSerializedOptionsRecordTrait;

/**
 * Trait FormFieldsTrait.
 *  * @property string $id
 * @property string $id_form
 * @property string $label
 * @property string $role
 * @property string $help
 * @property string $mandatory
 * @property string $visible
 * @property string $listing
 * @property string $filter
 *
 * @method string            getName()
 * @method AbstractTypeTrait getType()
 */
trait FormFieldTrait
{
    use RecordTrait;
    use HasSerializedOptionsRecordTrait;

    /**
     * @param $form
     *
     * @return mixed
     */
    public function addFormInput($form)
    {
        return $this->getType()->addFormInput($form);
    }

    /**
     * @param $form
     *
     * @return void
     */
    public function processValidation($form)
    {
        $this->getType()->processValidation($form);
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        $label = $this->getAttributeFromArray('label');

        return $label ? $label : $this->getType()->getLabel();
    }

    public function populateFromForm($form)
    {
        $this->id_form = $form->id;
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        return $this->getAttributeFromArray('help');
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function getItemValue($model)
    {
        return $this->getType()->getItemValue($model);
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function printItemValue($model)
    {
        $value = $this->getType()->printItemValue($model);

        return $value;
    }

    /**
     * @param Record|ModelWithFieldsRecordTrait $parent
     */
    public function populateFromParent($parent)
    {
        $pk = $parent->getManager()->getPrimaryFK();
        $this->{$pk} = $parent->getPrimaryKey();
    }

    public function populateFromType()
    {
        $type = $this->getType();
        $this->label = $type->getDefaultLabel();
        $this->visible = $type->getDefaultVisible();
        $this->mandatory = $type->getDefaultMandatory();
        $this->role = $type->getRole();
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->getAttributeFromArray('role');
    }

    /**
     * @param $form
     * @param $siblingForm
     *
     * @return mixed
     */
    public function populateFormFromSibling($form, $siblingForm)
    {
        return $this->getType()->populateFormFromSibling($form, $siblingForm);
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return 'no' != $this->visible;
    }

    /**
     * @return bool
     */
    public function isMandatory()
    {
        return 'no' != $this->mandatory;
    }

    /**
     * @param string $module
     *
     * @return bool
     */
    public function isListed($module = 'public')
    {
        $module = 'admin' == $module ? $module : 'public';

        return $this->hasListing($module);
    }

    /**
     * @param string $slug
     *
     * @return bool
     */
    public function hasListing($slug)
    {
        return in_array($slug, $this->getListingArray());
    }

    /**
     * @return mixed
     */
    public function getListingArray()
    {
        if (!$this->getRegistry()->has('listingArray')) {
            $this->getRegistry()->set('listingArray', explode(',', $this->listing));
        }

        return $this->getRegistry()->get('listingArray');
    }

    /**
     * @param string $module
     *
     * @return bool
     */
    public function isFiltered($module = 'public')
    {
        $module = 'admin' == $module ? $module : 'public';

        return $this->hasFilter($module);
    }

    /**
     * @param string $slug
     *
     * @return bool
     */
    public function hasFilter($slug)
    {
        return in_array($slug, $this->getFilterArray());
    }

    /**
     * @return array
     */
    public function getFilterArray()
    {
        if (!$this->getRegistry()->has('filterArray')) {
            $this->getRegistry()->set('filterArray', explode(',', $this->filter));
        }

        return $this->getRegistry()->get('filterArray');
    }
}
