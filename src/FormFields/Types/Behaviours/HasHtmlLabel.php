<?php

namespace ByTIC\FormBuilder\FormFields\Types\Behaviours;

use Nip\Form\Elements\AbstractElement;

/**
 * Trait HasHtmlLabel.
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
