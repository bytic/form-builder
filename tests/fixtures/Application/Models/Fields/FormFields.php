<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields;

use ByTIC\Common\Records\Records;
use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class FormField.
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
        return __NAMESPACE__.'\\';
    }
}
