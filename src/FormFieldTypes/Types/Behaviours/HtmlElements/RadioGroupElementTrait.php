<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasElementOptions;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasHtmlLabel;
use Nip_Form_Element_Abstract;
use Nip_Form_Element_RadioGroup;
use Nip_Form_Model as NipModelForm;

/**
 * Trait RadioGroupElementTrait.
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
        if ('false' == $autoSelectFirst) {
            $input->autoSelectFirst(false);
        }
        $input->getRenderer()->setSeparator('');

        return parent::initFormInput($input);
    }

    /**
     * @var NipModelForm
     */
    public function adminGetDataFromModel($form)
    {
        parent::adminGetDataFromModel($form);

        $this->adminFormAddOptionsFromModel($form);

        $form->addCheckbox('autoSelectFirst', 'AutoSelectFirst', false);
        if ('false' !== $form->getModel()->getOption('autoSelectFirst')) {
            $form->getElement('autoSelectFirst')->setChecked(true);
        }
    }

    /**
     * @var NipModelForm
     */
    public function adminSaveToModel($form)
    {
        parent::adminSaveToModel($form);

        $this->adminSaveToModelInputOptions($form);

        $autoSelectFirst = $form->getElement('autoSelectFirst')->getValue();
        $form->getModel()->setOption('autoSelectFirst', $autoSelectFirst ? 'true' : 'false');
    }
}
