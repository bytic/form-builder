<?php

namespace ByTIC\FormBuilder\Base\Models;

use ByTIC\Records\Behaviors\Duplicate\CanDuplicateRecordTrait;

/**
 */
class Record extends \Nip\Records\Record
{
    use CanDuplicateRecordTrait;
}
