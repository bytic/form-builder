<?php

/** @var FormFieldsTrait $manager */

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;

$this->set('manager', $manager);

/** @var array $importLinks */
$this->set('importLinks', $importLinks);

/** @var array $withParams */
$this->set('withParams', $withParams);
?>
<div id="form-fields-container" class="row">
    <div class="col-sm-3 available">
        <?= $this->load('modules/panels/index-available'); ?>
    </div>
    <div class="col-sm-7 existing">
        <?= $this->load('modules/panels/index-existing'); ?>
    </div>
    <div class="col-sm-2">
        <?= $this->load('modules/panels/index-actions'); ?>
    </div>
</div>
