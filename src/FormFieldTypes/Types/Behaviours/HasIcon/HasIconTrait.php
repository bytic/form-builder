<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HasIcon;

use ByTIC\FormBuilder\FormFieldTypes\Icons\FieldIcons;

trait HasIconTrait
{
    protected $icon = null;

    public function hasIcon()
    {
        return $this->getIcon() !== null;
    }

    public function getIcon()
    {
        if ($this->icon === null) {
            $this->icon = $this->generateIcon();
        }

        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    protected function generateIcon()
    {
        return $this->getDefaultIcon();
    }

    protected function getDefaultIcon(): string
    {
        return FieldIcons::DEFAULT_ICON;
    }
}