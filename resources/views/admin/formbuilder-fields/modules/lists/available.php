<?php

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use ByTIC\FormBuilder\FormFieldTypes\Types\AbstractType;
use ByTIC\FormBuilder\Utility\FormsBuilderModels;
use Nip\Records\RecordManager;

/** @var FormFieldsTrait|RecordManager $manager */
$manager = FormsBuilderModels::fields();

$withParams = is_array($this->withParams) ? $this->withParams : [];
$addUrlParams = $withParams + ['role' => $role];
if ($this->formBuilder) {
    $addUrlParams[$this->formBuilder->getManager()->getPrimaryFK()] = $this->formBuilder->getPrimaryKey();
}
/** @var AbstractType $fields */
?>
<div class='fields-container d-grid gap-2'>
    <?php foreach ($fields as $field) { ?>
        <?php $addUrl = $manager->compileURL('add', $addUrlParams + ['type' => $field->getName()]); ?>
        <div class="field">
            <div class="field-icon">
                <?= $field->getIcon(); ?>
            </div>
            <span class="field-name"><?= htmlspecialchars((string)$field->getLabel()); ?></span>
            <div class="btn-group">
                <a href="<?= $addUrl; ?>"
                   class="btn add-<?= htmlspecialchars((string)$field->getName()); ?>"
                   title="<?= translator()->trans('add'); ?>">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    <?php } ?>
</div>