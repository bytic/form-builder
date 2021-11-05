<?php

namespace ByTIC\FormBuilder\Models\Fields;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Fields
 * @package ByTIC\FormBuilder\Models\Forms
 */
class Fields extends RecordManager
{
    use SingletonTrait;

    public const TABLE = 'fb-fields';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }
}
