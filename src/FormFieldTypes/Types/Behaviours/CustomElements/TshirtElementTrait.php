<?php

namespace ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\CustomElements;

use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\HtmlElements\SelectElementTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\Behaviours\IsUnique\IsUniqueTrait;

trait TshirtElementTrait
{
    protected $aliases = ['tshirt'];

    use SelectElementTrait;
    use AbstractCustomElementTrait;
    use IsUniqueTrait;

    /**
     * @inheritdoc
     */
    public function getDefaultVisible(): string
    {
        return 'no';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultLabel()
    {
        return translator()->trans('tshirt_size');
    }

    /**
     * @inheritdoc
     */
    public function getDefaultOptions(): array
    {
        $options = parent::getDefaultOptions();
        $options['select_options'] = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $options['select_no_value'] = '---';
        return $options;
    }
}