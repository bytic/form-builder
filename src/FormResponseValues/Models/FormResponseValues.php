<?php

namespace ByTIC\FormBuilder\FormResponseValues\Models;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
use ByTIC\Records\Behaviors\I18n\I18nRecordsTrait;
use Nip\Records\Filters\Records\HasFiltersRecordsTrait;
use Nip\Records\RecordManager;

/**
 * Class Forms.
 * @method FormResponseValue getNew()
 */
class FormResponseValues extends RecordManager
{
    use HasFormsRecordsTrait;
    use I18nRecordsTrait;
    use HasFiltersRecordsTrait;
    use FormResponseValuesTrait;

    public const TABLE = 'formbuilder-response_values';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Forms\Models\\';
    }
}
