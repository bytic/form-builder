<?php

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use Nip\Records\RecordManager;

/** @var FormFieldsTrait|RecordManager $manager */
$manager = $this->manager;
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
                $addUrlParams = $this->withParams + ['type' => $field->getName(), 'role' => $role];
                $addUrl = $manager->compileURL('add', $addUrlParams);
                ?>
                <a href="<?= $addUrl; ?>"
                   class="btn btn-success btn-xs pull-right add-<?= $field->getName(); ?>">
                    +
                </a>
            </div>
        </div>
    <?php } ?>
</div>