<?php
/** @var FormFieldTrait[] $fields */

/** @var string $updateUrl */

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;

?>
<div class='sortable fields-container' data-url="<?= $updateUrl; ?>">
    <?php if (empty($fields)) { ?>
        <div class="fb-empty-state">
            <span class="fb-empty-state-icon">⬡</span>
            <p><?= translator()->trans('form-builder.fields.empty_state') ?? 'No fields yet — drag from the palette to add one.'; ?></p>
        </div>
    <?php } ?>
    <?php foreach ($fields as $field) { ?>
        <?php
        $listIcons    = ($field->hasListing('public'))  ? 'field-visible fas fa-list' : 'field-invisible fas fa-list';
        $filterIcons  = ($field->hasFilter('public'))   ? 'field-visible fas fa-filter' : 'field-invisible fas fa-filter';
        $visibleIcons = ($field->visible === 'no')      ? 'field-invisible fas fa-eye-slash' : 'field-visible far fa-eye';
        $fieldType = $field->getType();
        ?>
        <div id="field_<?= $field->id; ?>"
             class="field field-<?= $field->getRole(); ?>-<?= $fieldType->getName(); ?>">
            <div class="field-icon">
                <?= $fieldType->getIcon(); ?>
            </div>

            <div class="field-flags" title="visible / listing / filter">
                <i class="<?= $visibleIcons; ?>"></i>
                <i class="<?= $listIcons; ?>"></i>
                <i class="<?= $filterIcons; ?>"></i>
            </div>

            <div class="name flex-grow-1 fw-medium text-truncate">
                <?= htmlspecialchars((string)$field->getLabel()); ?>
                <?= $field->isMandatory() ? '<span class="text-danger ms-1" title="Required">*</span>' : ''; ?>
            </div>

            <span class="field-type-badge"><?= htmlspecialchars((string)$fieldType->getLabel()); ?></span>

            <div class="btn-group">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"
                        aria-label="<?= translator()->trans('actions'); ?>">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="<?= $field->getURL(); ?>" class="dropdown-item action-edit">
                            <i class="fas fa-pencil-alt me-2"></i><?= translator()->trans('edit'); ?>
                        </a>
                    </li>
                    <?php if ($field->getType()->canDelete()) { ?>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a href="<?= $field->compileURL('delete'); ?>"
                               class="dropdown-item action-delete text-danger"
                               onclick="return confirm('<?= translator()->trans('general.messages.confirm'); ?>');">
                                <i class="far fa-trash-alt me-2"></i><?= translator()->trans('delete'); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>
