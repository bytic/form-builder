<div class="card card-inverse">
    <div class="card-header">
        <h4 class="card-title text-white">
            <?= translator()->trans('details'); ?>
        </h4>
        <div class="card-header-btn">
            <a href="<?php echo $this->item->getEditURL(); ?>" class="btn btn-sm btn-info">
                <?= translator()->trans('edit'); ?>
            </a>
        </div>
    </div>
    <?= $this->load("/formbuilder-forms/module/item/details"); ?>
</div>
