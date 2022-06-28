<?php

namespace ByTIC\FormBuilder\Tests\Fixtures\Application\Models\Fields;

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class FormField.
 */
class FormFields extends RecordManager
{
    use FormFieldsTrait;
    use SingletonTrait;

    /**
     * @return string
     */
    public function getModelNamespace()
    {
        return __NAMESPACE__.'\\';
    }
}
