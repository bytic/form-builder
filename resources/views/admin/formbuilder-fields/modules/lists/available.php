<?php

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use Nip\Records\RecordManager;

/** @var FormFieldsTrait|RecordManager $manager */
$manager = FormsBuilderModels::fields();

$addUrlParams = $this->withParams + ['role' => $role];
if ($this->formBuilder) {
    $addUrlParams[$this->formBuilder->getManager()->getPrimaryFK()] = $this->formBuilder->getPrimaryKey();
}
/** @var AbstractType $fields */
?>
<div class='fields-container d-grid grid gap-2'>
    <?php foreach ($fields as $field) { ?>
        <div class="field border rounded">
            <span class="field-icon">
                <?= $field->getIcon(); ?>
            </span>
            <span class="field-name">
                <?= $field->getLabel(); ?>
            </span>
            <div class="btn-group">
                <?php
                $addUrl = $manager->compileURL('add', $addUrlParams + ['type' => $field->getName()]);
                ?>
                <a href="<?= $addUrl; ?>"
                   class="btn btn-success btn-xs pull-right add-<?= $field->getName(); ?>">
                    +
                </a>
            </div>
        </div>
    <?php } ?>
</div>