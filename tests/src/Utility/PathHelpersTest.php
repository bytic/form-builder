<?php

namespace ByTIC\FormBuilder\Tests\Utility;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Utility\PathsHelpers;

/**
 * Class PathHelpersTest
 * @package ByTIC\FormBuilder\Tests\Utility
 */
class PathHelpersTest extends AbstractTest
{
    public function test_views()
    {
        $path = PathsHelpers::views('/admin/formbuilder-forms/modules/item-row.php');
        $content = file_get_contents($path);
        self::assertStringContainsString('$item', $content);
    }
}