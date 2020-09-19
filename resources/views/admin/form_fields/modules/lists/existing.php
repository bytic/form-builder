<?php
/** @var \ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait[] $fields */
?>
<ul class='list-unstyled sortable fields-container' data-url="<?php echo $updateUrl; ?>">
    <?php foreach ($fields as $field) { ?>
        <li id="field_<?php echo $field->id; ?>"
            class="field field-<?php echo $field->getRole(); ?>-<?php echo $field->getType()->getName(); ?>">
            <div class="row row-fluid">
                <div class="name col-7 col-xs-7">
                    <?php $visibleIcons = ($field->visible == 'no') ? 'field-invisible fas fa-eye-slash' : 'field-visible far fa-eye' ?>
                    <i class=" <?php echo $visibleIcons; ?>"></i>

                    <?php $listIcons = ($field->hasListing('public')) ? 'field-visible' : 'field-invisible' ?>
                    <i class="far fa-list-alt <?php echo $listIcons; ?>"></i>

                    <?php $filterIcons = ($field->hasFilter('public')) ? 'field-visible' : 'field-invisible' ?>
                    <i class=" fas fa-filter <?php echo $filterIcons; ?>"></i>

                    <?php echo $field->getLabel(); ?>
                    <?php echo $field->isMandatory() ? '*' : ''; ?>
                </div>

                <div class="col-3 col-xs-3">
                    <span style="font-size:9px;">
                        [<?php echo $field->getType()->getLabel(); ?>]
                    </span>
                </div>
                <div class="col-2 col-xs-2">
                    <div class="pull-right btn-group">
                        <a href="<?php echo $field->getURL(); ?>" class="btn btn-success btn-xs">
                            <i class="fas fa-edit"></i>
                        </a>
                        <?php if ($field->getType()->canDelete()) { ?>
                            <a href="<?php echo $field->compileURL('delete'); ?>" class="btn btn-danger btn-xs"
                               onclick="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </li>
    <?php } ?>
</ul>
