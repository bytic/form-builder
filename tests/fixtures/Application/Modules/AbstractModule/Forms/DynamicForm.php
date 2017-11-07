<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Modules\AbstractModule\Forms;

use ByTIC\FormBuilder\Application\Modules\AbstractModule\Forms\Traits\DynamicFormTrait;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields\FormField;
use Nip\Records\Collections\Collection;

/**
 * Class DynamicForm
 * @package ByTIC\FormBuilder\Tests\Fixtures\Application\Modules\AbstractModule\Forms
 */
class DynamicForm extends \Nip_Form_Model
{
    use DynamicFormTrait;

    /**
     * @inheritdoc
     */
    protected function generateFormFields()
    {
        $types = new Collection();
        $types->add(new FormField(), 'id');
        $types->add(new FormField(), 'id');
        return $types;
    }
}
