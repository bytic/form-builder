<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields;

use ByTIC\Common\Records\Record;
use ByTIC\FormBuilder\Application\Models\ModelWithFields\Traits\ModelWithFieldsRecordTrait;
use ByTIC\FormBuilder\FormFields\Models\FormFields\Behaviours\FormActions\FormActionsRecordTrait;
use ByTIC\FormBuilder\FormFields\Models\FormFields\Behaviours\HasLabel\HasLabelRecordTrait;
use ByTIC\FormBuilder\FormFields\Models\FormFields\Behaviours\HasTypes\HasTypesRecordTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeTrait;
use ByTIC\Records\Behaviors\HasForms\HasFormsRecordTrait;
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
 * @method AbstractTypeTrait getType()
 */
trait FormFieldTrait
{
    use HasTypesRecordTrait;
    use HasFormsRecordTrait;
    use HasSerializedOptionsRecordTrait;
    use FormActionsRecordTrait;
    use HasLabelRecordTrait;

    public function getName()
    {
        return $this->getLabel();
    }

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

    public function populateFromForm($form)
    {
        $this->id_form = $form->id;
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
        $this->initLabelFromType($type);

        $this->listing = $type->getDefaultListing();
        $this->visible = $type->getDefaultVisible();
        $this->mandatory = $type->getDefaultMandatory();
        $this->filter = $type->getDefaultFilter();

        $this->role = $type->getRole();

        $options = $type->getDefaultOptions();
        foreach ($options as $option => $value) {
            $this->setOption($option, $value);
        }
    }

    /**
     * @param FormFieldTrait $sibling
     */
    public function populateFromSibling($sibling)
    {
        foreach ([
                     'role',
                     'label',
                     'label_intern',
                     'help',
                     'options',
                     'type',
                     'listing',
                     'visible',
                     'mandatory',
                     'filter',
                     'pos',
                 ] as $col) {
            $this->setPropertyValue($col, $sibling->getPropertyRaw($col));
        }
        $this->initOptions();
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
    public function isFormVisible()
    {
        return $this->visible != 'hidden';
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
            $listingArray = empty($this->listing) ? [] : explode(',', $this->listing);
            $this->getRegistry()->set('listingArray', $listingArray);
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
            $filterArray = empty($this->filter) ? [] : explode(',', $this->filter);
            $this->getRegistry()->set('filterArray', $filterArray);
        }

        return $this->getRegistry()->get('filterArray');
    }

    public function getFormBuilder()
    {
        return $this->getRelation('FormBuilder')->getResults();
    }

    /**
     * @return bool
     */
    public function insert()
    {
        $this->serializeOptions();
        $return = parent::insert();

        return $return;
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $this->serializeOptions();
        $return = parent::update();

        return $return;
    }
}
