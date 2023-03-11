<?php

namespace ByTIC\FormBuilder\Models\Forms;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
use ByTIC\Records\Behaviors\I18n\I18nRecordsTrait;
use Nip\Records\Filters\Records\HasFiltersRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Forms.
 * @method Form getNew()
 */
class Forms extends RecordManager
{
    use HasFormsRecordsTrait;
    use I18nRecordsTrait;
    use HasFiltersRecordsTrait;
    use FormsTrait;

    public const TABLE = 'formbuilder-forms';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }
}
