<?php

namespace ByTIC\FormBuilder\Models\Forms;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Forms
 * @package ByTIC\FormBuilder\Models\Forms
 */
class Forms extends RecordManager
{
    use SingletonTrait;
    use \ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
    use \ByTIC\Records\Behaviors\I18n\I18nRecordsTrait;

    public const TABLE = 'formbuilder-forms';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }

    protected function generateController()
    {
        return static::TABLE;
    }
}
