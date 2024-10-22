<?php

namespace ByTIC\FormBuilder\Base\Models;

use ByTIC\Records\Behaviors\Duplicate\CanDuplicateRecordsTrait;

class RecordManager extends \Nip\Records\RecordManager
{
    use CanDuplicateRecordsTrait;
}