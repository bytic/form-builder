<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\Behaviours\HasElementOptions;
use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\Behaviours\HasHtmlLabel;
use Nip_Form_Element_Abstract;
use Nip_Form_Element_RadioGroup;
use Nip_Form_Model as NipModelForm;

/**
 * Trait RadioGroupElementTrait
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements
 */
trait RadioGroupElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasElementOptions;
    use HasHtmlLabel;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('radioGroup');
    }

    /**
     * @param Nip_Form_Element_Abstract|Nip_Form_Element_RadioGroup $input
     *
     * @return mixed
     */
    public function initFormInput($input)
    {
        $this->populateFormInputOptions($input);
        $this->htmlDecodeLabel($input);

        $autoSelectFirst = $this->getItem()->getOption('autoSelectFirst');
        if ($autoSelectFirst == 'false') {
            $input->autoSelectFirst(false);
        }
        $input->getRenderer()->setSeparator('');

        return parent::initFormInput($input);
    }



    /**
     * @var $form NipModelForm
     */
    public function adminGetDataFromModel($form)
    {
        parent::adminGetDataFromModel($form);

        $this->adminFormAddOptionsFromModel($form);

        $form->addCheckbox('autoSelectFirst', 'AutoSelectFirst', false);
        if ($form->getModel()->getOption('autoSelectFirst') !== 'false') {
            $form->getElement('autoSelectFirst')->setChecked(true);
        }
    }


    /**
     * @var $form NipModelForm
     */
    public function adminSaveToModel($form)
    {
        parent::adminSaveToModel($form);

        $this->adminSaveToModelInputOptions($form);

        $autoSelectFirst = $form->getElement('autoSelectFirst')->getValue();
        $form->getModel()->setOption('autoSelectFirst', $autoSelectFirst ? 'true' : 'false');
    }
}
