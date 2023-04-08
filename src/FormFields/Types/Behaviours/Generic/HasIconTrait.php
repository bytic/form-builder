<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours\Generic;

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

    protected function getDefaultIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="field-iconSvg"><path fill-rule="evenodd" d="M14 2a1 1 0 1 0 0 2 2 2 0 0 1 2 2v12a2 2 0 0 1-2 2 1 1 0 1 0 0 2 4 4 0 0 0 3-1.354A3.998 3.998 0 0 0 20 22a1 1 0 1 0 0-2 2 2 0 0 1-2-2V6a2 2 0 0 1 2-2 1 1 0 1 0 0-2 4 4 0 0 0-3 1.354 3.979 3.979 0 0 0-1.47-1.05A4 4 0 0 0 14 2Zm1 4H3a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12v-2H3V8h12V6Zm4 12v-2h2V8h-2V6h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2ZM7.61 10.216l-.64 2.36c0 .016.005.032.016.049.01.01.024.016.04.016H8.21c.017 0 .03-.005.041-.016.017-.017.022-.033.017-.05l-.641-2.359c0-.005-.003-.008-.009-.008-.005 0-.008.003-.008.008ZM5.334 15a.314.314 0 0 1-.272-.14.318.318 0 0 1-.04-.304l1.725-5.112a.698.698 0 0 1 .239-.32A.637.637 0 0 1 7.364 9h.542c.143 0 .269.041.378.123a.63.63 0 0 1 .239.32l1.734 5.113a.305.305 0 0 1-.05.304.314.314 0 0 1-.27.14h-.551a.624.624 0 0 1-.37-.123.643.643 0 0 1-.222-.33l-.206-.78c-.005-.044-.035-.066-.09-.066H6.739c-.05 0-.08.022-.09.066l-.206.78a.583.583 0 0 1-.222.33.601.601 0 0 1-.37.123h-.517Z" clip-rule="evenodd"></path></svg>';
    }
}