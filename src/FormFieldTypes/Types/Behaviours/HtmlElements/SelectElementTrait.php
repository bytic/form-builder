<?php

declare(strict_types=1);

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;
use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\AbstractTypeInterfaceTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasElementOptions;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasHtmlLabel;
use Nip_Form_Element_Select as FormSelect;
use Nip_Form_Model as NipModelForm;

/**
 * Trait SelectElementTrait.
 */
trait SelectElementTrait
{
    use AbstractTypeInterfaceTrait;
    use HasElementOptions;
    use HasHtmlLabel;

    /**
     * SelectElement constructor.
     */
    public function __construct()
    {
        $this->setInputType('select');
        $this->elementsOptionsName = 'select_options';
    }

    /**
     * @param FormSelect $input
     */
    public function initFormInput($input)
    {
        $this->initFormInputDefaultOption($input);
        $this->initFormInputOptions($input);
        $this->htmlDecodeLabel($input);

        return parent::initFormInput($input);
    }

    /**
     * @param FormSelect $input
     */
    protected function initFormInputDefaultOption($input)
    {
        $noValue = $this->getItem()->getOption('select_no_value');
        if ($noValue) {
            $input->addOption('', $noValue);
        }
    }

    /**
     * @param FormSelect $input
     */
    protected function initFormInputOptions($input)
    {
        $options = $this->getItem()->getOption('select_options');

        $isInAdmin = $input->getForm()->isInAdmin();
        $hideDisabled = 'yes' == $this->getItem()->getOption('hide_disabled');
        $optionsDisabled = $this->getItem()->getOption('select_options_disabled');
        $optionsDisabled = \is_array($optionsDisabled) ? $optionsDisabled : [];

        if (\is_array($options)) {
            foreach ($options as $value) {
                $attribs = [
                    'label' => $value,
                ];
                if (\in_array($value, $optionsDisabled)) {
                    if ($hideDisabled && !$isInAdmin) {
                        continue;
                    }
                    $attribs['label'] .= ' (' . translator()->trans('unavailable') . ')';

                    if (!$isInAdmin) {
                        $attribs['disabled'] = 'disabled';
                    }
                }
                $input->addOption($value, $attribs);
            }
        }
    }

    /**
     * @var NipModelForm
     */
    public function adminGetDataFromModel($form)
    {
        parent::adminGetDataFromModel($form);

        $this->adminFormAddSelelectOptionsFromModel($form);
        $this->adminFormAddSelelectOptionsDisabledFromModel($form);
        $this->adminFormAddHideDisabledFromModel($form);
        $this->adminFormAddNoValueFromModel($form);
    }

    public function adminFormAddSelelectOptionsFromModel($form)
    {
        $this->adminFormAddOptionsFromModel($form, 'select_options', 'Select Options', true);
    }

    public function adminFormAddSelelectOptionsDisabledFromModel($form)
    {
        $this->adminFormAddOptionsFromModel($form, 'select_options_disabled', 'Disabled Options', false);
    }

    protected function adminFormAddHideDisabledFromModel($form)
    {
        $hideDisabledType = $form->isElementsType('BsRadioGroup') ? 'BsRadioGroup' : 'RadioGroup';
        $form->{'add' . $hideDisabledType}('hide_disabled', translator()->trans('hide_disabled'), true);
        $form->getElement('hide_disabled')
            ->addOption('yes', translator()->trans('yes'))
            ->addOption('no', translator()->trans('no'))
            ->getRenderer()->setSeparator('');
    }

    public function adminFormAddNoValueFromModel($form)
    {
        /** @var FormFieldTrait $model */
        $model = $form->getModel();

        $form->addInput('select_no_value', 'Default NoValue', false);
        $form->getElement('select_no_value')->setValue($model->getOption('select_no_value'));
    }

    public function adminSaveToModel($form)
    {
        parent::adminSaveToModel($form);

        /** @var FormFieldTrait $model */
        $model = $form->getModel();

        $this->adminSaveToModelSelectOptions($form);
        $this->adminSaveToModelSelectOptionsDisabled($form);

        $model->setOption('hide_disabled', $form->getElement('hide_disabled')?->getValue());
        $model->setOption('select_no_value', $form->getElement('select_no_value')?->getValue());
    }

    protected function adminSaveToModelSelectOptions($form)
    {
        $this->adminSaveToModelInputOptions($form, 'select_options');
    }

    protected function adminSaveToModelSelectOptionsDisabled($form)
    {
        $this->adminSaveToModelInputOptions($form, 'select_options_disabled');
    }

    protected function getDefaultIcon(): string
    {
        return FieldIcons::SELECT_DROPDOWN;
    }
}
