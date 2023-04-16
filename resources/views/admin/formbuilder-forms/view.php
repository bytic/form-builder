<?php

use ByTIC\FormBuilder\FormBuilder;

$this->Stylesheets()->addRaw(FormBuilder::loadAssetContent('/css/admin.css'));
$this->Scripts()->addRaw(FormBuilder::loadAssetContent('/js/sortable.js'));
?>

<?= $this->Flash()->render($this->controller); ?>

<?= $this->load(
    '/formbuilder-fields/index',
    [
        'designer' => $this->designer,
        'fields' => $this->fields,
        'manager' => $this->modelManager,
        'withParams' => $this->addWithParams,
        'importLinks' => [],
    ]
); ?>

