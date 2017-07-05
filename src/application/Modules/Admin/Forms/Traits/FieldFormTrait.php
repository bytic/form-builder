<?php

namespace ByTIC\FormBuilder\Application\Modules\Admin\Forms\Traits;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use Nip\Records\Record;
use Nip\Records\RecordManager;

/**
 * Trait FieldFormTrait
 * @package ByTIC\FormBuilder\Application\Modules\Admin\Forms\Traits
 *
 * @method Record|FormFieldTrait getModel()
 */
trait FieldFormTrait
{
    public function init()
    {
        parent::init();

        $this->addSelect('type', translator()->translate('type'), true);
        $this->getElement('type')->setAttrib('disabled', 'disabled');

        $this->addInput('label', translator()->translate('name'), true);

        $this->addInput('label_intern', translator()->translate('internal_name'));

        $this->addInput('help', 'help');

        $this->initVisibleElement();
        $this->initMandatoryElement();
        $this->initListingElement();
        $this->initFilterElement();

        $this->addButton('save', translator()->translate('submit'));
    }

    protected function initVisibleElement()
    {
        $this->addBsRadioGroup('visible', translator()->translate('visible'), true);
        $this->visible->addOption('yes', translator()->translate('yes'))
            ->addOption('no', translator()->translate('no'))
            ->getRenderer()->setSeparator('');
    }

    protected function initMandatoryElement()
    {
        $this->addBsRadioGroup('mandatory', translator()->translate('mandatory'), true);
        $this->mandatory->addOption('yes', translator()->translate('yes'))
            ->addOption('no', translator()->translate('no'))
            ->getRenderer()->setSeparator('');

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

        $this->listing->setValue($this->getModel()->getListingArray());
        $this->filter->setValue($this->getModel()->getFilterArray());
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

        $this->getModel()->listing = implode(',', $this->getElement('listing')->getValue());
        $this->getModel()->filter = implode(',', $this->getElement('filter')->getValue());
        $this->getModel()->getType()->adminSaveToModel($this);
    }
}