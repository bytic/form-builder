<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\AbstractTypeInterfaceTrait;
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
     * @param Nip_Form_Element_Abstract|Nip_Form_Element_RadioGroup $input
     */
    public function populateFormInputOptions($input)
    {
        $values = $this->getItem()->getOption('check_options');
        if (is_array($values)) {
            foreach ($values as $value) {
                $input->addOption($value, $value);
            }
        }
    }

    /**
     * @var $form NipModelForm
     */
    public function adminGetDataFromModel($form)
    {
        parent::adminGetDataFromModel($form);

        $form->addTextarea('check_options', translator()->translate('check_options'), true);
        $form->getElement('check_options')->setValue(
            implode("\n", $form->getModel()->getOption('check_options'))
        );

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

        $values = $form->getElement('check_options')->getValue();
        $values = array_map('trim', explode("\n", $values));
        $form->getModel()->setOption('check_options', $values);

        $autoSelectFirst = $form->getElement('autoSelectFirst')->getValue();
        $form->getModel()->setOption('autoSelectFirst', $autoSelectFirst ? 'true' : 'false');
    }
}
