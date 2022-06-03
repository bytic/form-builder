<?php

namespace ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\Behaviours;

use Nip\Form\Elements\AbstractElement;

/**
 * Trait HasHtmlLabel
 * @package ByTIC\FormBuilder\Application\Models\Fields\Types\Traits\Behaviours
 */
trait HasHtmlLabel
{
    /**
     * @param AbstractElement $input
     */
    public function htmlDecodeLabel($input)
    {
        $label = $input->getLabel();
        $label = html_entity_decode($label);
        $title = strip_tags($label);

        $input->setAttrib('title', $title);
        $input->setLabel($label);
    }
}
