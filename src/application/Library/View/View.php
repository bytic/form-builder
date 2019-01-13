<?php

namespace ByTIC\FormBuilder\Application\Library\View;

use ByTIC\FormBuilder\FormBuilder;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class View
 * @package ByTIC\FormBuilder\Application\Library\View
 */
class View extends \Nip\View
{
    use SingletonTrait;

    /** @noinspection PhpMissingParentCallCommonInspection
     *
     * @return string
     */
    protected function generateBasePath()
    {
        return FormBuilder::basePath()
            . DIRECTORY_SEPARATOR . 'resources'
            . DIRECTORY_SEPARATOR . 'views';
    }
}
