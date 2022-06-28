<?php

namespace ByTIC\FormBuilder\Tests\Application\Modules\AbstractModule\Forms;

use ByTIC\FormBuilder\Tests\AbstractTest;
use ByTIC\FormBuilder\Tests\Fixtures\Application\Modules\AbstractModule\Forms\DynamicForm;
use Nip\Records\Collections\Collection;

/**
 * Class DynamicFormTest.
 */
class DynamicFormTest extends AbstractTest
{
    public function testGetFields()
    {
        $form = new DynamicForm();
        $fields = $form->getFields();

        self::assertInstanceOf(Collection::class, $fields);
    }
}
