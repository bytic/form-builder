<?php
/** @var FormFieldTrait[] $fields */

/** @var string $updateUrl */

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;

?>
<div class='sortable fields-container' data-url="<?= $updateUrl; ?>">
    <?php foreach ($fields as $field) { ?>
        <?php
        $listIcons = ($field->hasListing('public')) ? 'field-visible' : 'field-invisible';
        $filterIcons = ($field->hasFilter('public')) ? 'field-visible' : 'field-invisible';
        $visibleIcons = ($field->visible == 'no') ? 'field-invisible fas fa-eye-slash' : 'field-visible far fa-eye';
        $fieldType = $field->getType();
        ?>
        <div id="field_<?= $field->id; ?>"
             class="field field-<?= $field->getRole(); ?>-<?= $fieldType->getName(); ?> p-2">
            <div class="d-flex gap-3">
                <div class="field-icon">
                    <?= $fieldType->getIcon(); ?>
                </div>
                <div class="field-flags">
                    <i class="<?= $visibleIcons; ?>"></i>
                    <i class="far fa-list-alt <?= $listIcons; ?>"></i>
                    <i class=" fas fa-filter <?= $filterIcons; ?>"></i>
                </div>

                <div class="name flex-grow-1">
                    <?= $field->getLabel(); ?>
                    <?= $field->isMandatory() ? '*' : ''; ?>
                </div>

                <div class="mx-2">
                    <span style="font-size:9px;">
                        [<?= $fieldType->getLabel(); ?>]
                    </span>
                </div>
                <div class="btn-group">
                    <button class="btn btn-primary btn-flat btn-xs dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= $field->getURL(); ?>" class="dropdown-item">
                                <i class="fas fa-edit"></i>
                                <?= translator()->trans('edit'); ?>
                            </a>
                        </li>
                        <?php if ($field->getType()->canDelete()) { ?>
                            <li>
                                <a href="<?= $field->compileURL('delete'); ?>" class="dropdown-item"
                                   onclick="return confirm('<?= translator()->trans(
                                       'general.messages.confirm'
                                   ); ?>');">
                                    <i class="far fa-trash-alt"></i>
                                    <?= translator()->trans('delete'); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
