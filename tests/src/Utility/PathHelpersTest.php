<?php

namespace ByTIC\FormBuilder\Tests\Utility;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Utility\PathsHelpers;

/**
 * Class PathHelpersTest.
 */
class PathHelpersTest extends AbstractTest
{
    public function testViews()
    {
        $path = PathsHelpers::views('/admin/formbuilder-forms/modules/item-row.php');
        $content = file_get_contents($path);
        self::assertStringContainsString('$item', $content);
    }
}
