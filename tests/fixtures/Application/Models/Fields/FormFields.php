<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields;

use ByTIC\Common\Records\Records;
use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class FormField
 * @package ByTIC\FormBuilder\Tests\Fixtures\Application\Modules\AbstractModule\Forms
 */
class FormFields extends Records
{
    use FormFieldsTrait;
    use SingletonTrait;

    /** @noinspection PhpMissingParentCallCommonInspection
     * @return string
     */
    public function getModelNamespace()
    {
        return __NAMESPACE__ . '\\';
    }
}
