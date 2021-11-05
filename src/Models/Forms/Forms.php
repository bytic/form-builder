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

    public const TABLE = 'fb-forms';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }
}
