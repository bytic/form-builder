<?php

namespace ByTIC\FormBuilder\FormFields\Models\FormFields\Behaviours\HasLabel;

trait HasLabelRecordTrait
{

    /**
     * @return string
     */
    public function getLabel()
    {
        $label = $this->getAttributeFromArray('label');

        return $label ? $label : $this->getType()->getLabel();
    }

    protected function initLabelFromType($type = null)
    {
        $type = $type ? $type : $this->getType();
        $this->label = $type->getDefaultLabel();
    }
}

