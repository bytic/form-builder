<ul class='list-unstyled sortable fields-container'>
    <?php foreach ($fields as $field) { ?>
        <li id="field_<?php echo $field->id; ?>" class="field">
            <div class="row">
                <div class="name col-xs-7">
                    <?php $visibleIcons = ($field->visible == 'no') ? 'field-invisible glyphicon-eye-close' : 'field-visible glyphicon-eye-open' ?>
                    <span class="glyphicon <?php echo $visibleIcons; ?>"></span>

                    <?php $listIcons = ($field->hasListing('public')) ? 'field-visible' : 'field-invisible' ?>
                    <span class="glyphicon glyphicon-th-list <?php echo $listIcons; ?>"></span>

                    <?php $filterIcons = ($field->hasFilter('public')) ? 'field-visible' : 'field-invisible' ?>
                    <span class="glyphicon glyphicon-filter <?php echo $filterIcons; ?>"></span>

                    <?php echo $field->getLabel(); ?>
                    <?php echo $field->isMandatory() ? '*' : ''; ?>
                </div>

                <div class="col-xs-3">
                    <span style="font-size:9px;">
                        [<?php echo $field->getType()->getLabel(); ?>]
                    </span>
                </div>
                <div class="col-xs-2">
                    <div class="pull-right btn-group">
                        <a href="<?php echo $field->getURL(); ?>" class="btn btn-success btn-xs">
                            <span class="glyphicon glyphicon-pencil glyphicon-white"></span>
                        </a>
                        <?php if ($field->getType()->canDelete()) { ?>
                            <a href="<?php echo $field->getDeleteURL(); ?>" class="btn btn-danger btn-xs"
                               onclick="return confirm('<?php echo translator()->translate('general.messages.confirm'); ?>');">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </li>
    <?php } ?>
</ul>