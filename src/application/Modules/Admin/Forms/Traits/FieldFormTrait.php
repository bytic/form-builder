<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Forms\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use Nip\Form\Elements\AbstractElement;
use Nip\Records\Record;
use Nip\Records\RecordManager;

/**
 * Trait FieldFormTrait.
 *
 * @method Record|FormFieldTrait getModel()
 * @method AbstractElement       getElement()
 */
trait FieldFormTrait
{
    public function init()
    {
        parent::init();

        $this->addSelect('type', translator()->trans('type'), false);
        $this->getElement('type')->setAttrib('disabled', 'disabled');

        $this->addInput('label', translator()->trans('name'), true);

        $this->addInput('label_intern', translator()->trans('internal_name'));

        $this->addInput('help', 'help');

        $this->initVisibleElement();
        $this->initMandatoryElement();

        if ($this->hasListingFlags()) {
            $this->initListingElement();
        }
        if ($this->hasFilterFlags()) {
            $this->initFilterElement();
        }

        $this->addButton('save', translator()->trans('submit'));
    }

    protected function initVisibleElement()
    {
        $this->addBsRadioGroup('visible', translator()->trans('visible'), true);
        $this->visible->addOption('yes', translator()->trans('yes'))
            ->addOption('no', translator()->trans('no'))
            ->getRenderer()->setSeparator('');
    }

    protected function initMandatoryElement()
    {
        $this->addBsRadioGroup('mandatory', translator()->trans('mandatory'), true);
        $this->mandatory->addOption('yes', translator()->trans('yes'))
            ->addOption('no', translator()->trans('no'))
            ->getRenderer()->setSeparator('');
    }

    /**
     * @return bool
     */
    protected function hasListingFlags()
    {
        return count($this->getListingFlags());
    }

    /**
     * @return array
     */
    protected function getListingFlags()
    {
        return [];
    }

    protected function initListingElement()
    {
        $this->addCheckboxGroup('listing', $this->getModelManager()->getLabel('form.listing'), false);
        $this->listing->addOption('public', $this->getModelManager()->getLabel('form.listing.public'))
            ->addOption('admin', $this->getModelManager()->getLabel('form.listing.admin'))
            ->getRenderer()->setSeparator('');
    }

    /**
     * @return RecordManager
     */
    abstract public function getModelManager();

    /**
     * @return bool
     */
    protected function hasFilterFlags()
    {
        return count($this->getFilterFlags());
    }

    /**
     * @return array
     */
    protected function getFilterFlags()
    {
        return [];
    }

    protected function initFilterElement()
    {
        $this->addCheckboxGroup('filter', $this->getModelManager()->getLabel('form.filter'), false);
        $this->filter->addOption('public', $this->getModelManager()->getLabel('form.filter.public'))
            ->addOption('admin', $this->getModelManager()->getLabel('form.filter.admin'))
            ->getRenderer()->setSeparator('');
    }

    public function getDataFromModel()
    {
        $fields = $this->getModel()->getManager()->getTypes();
        foreach ($fields as $field) {
            $this->getElement('type')->addOption($field->getName(), $field->getLabel());
        }

        parent::getDataFromModel();

        if ($this->hasListingFlags()) {
            $this->getElement('listing')->setValue($this->getModel()->getListingArray());
        }
        if ($this->hasFilterFlags()) {
            $this->getElement('filter')->setValue($this->getModel()->getFilterArray());
        }
        $this->getModel()->getType()->adminGetDataFromModel($this);
    }

    public function processValidation()
    {
        parent::processValidation();
        $this->getModel()->getType()->adminProcessValidation($this);
    }

    public function saveToModel()
    {
        parent::saveToModel();

        if ($this->hasFilterFlags()) {
            $this->getModel()->listing = implode(',', $this->getElement('listing')->getValue());
        }
        if ($this->hasFilterFlags()) {
            $this->getModel()->filter = implode(',', $this->getElement('filter')->getValue());
        }
        $this->getModel()->getType()->adminSaveToModel($this);
    }
}
