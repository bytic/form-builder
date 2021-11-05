<?php

namespace ByTIC\FormBuilder\Models\Values;

use Nip\Records\RecordManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Values
 * @package ByTIC\FormBuilder\Models\Values
 */
class Values extends RecordManager
{
    use SingletonTrait;

    public const TABLE = 'fb-values';

    public function getRootNamespace()
    {
        return 'ByTIC\FormBuilder\Models\\';
    }
}
