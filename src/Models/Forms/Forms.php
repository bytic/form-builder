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
    use \Nip\Records\Filters\Records\HasFiltersRecordsTrait;
    use FormsTrait;

    public const TABLE = 'formbuilder-forms';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }

}
