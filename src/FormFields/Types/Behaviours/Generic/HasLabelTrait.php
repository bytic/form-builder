<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours\Generic;

trait HasLabelTrait
{
    /**
     * @return string
     */
    public function generateLabel()
    {
        return $this->getDefaultLabel();
    }

    /**
     * @return string
     */
    public function getDefaultLabel()
    {
        return $this->getName();
    }

    /**
     * {@inheritdoc}
     */
    protected function hasShortLabel()
    {
        return false;
    }
}