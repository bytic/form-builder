<?php

use ByTIC\FormBuilder\FormFields\Models\FormFields\FormFieldsTrait;

/** @var FormFieldsTrait $manager */

$this->set('manager', $manager);

/** @var array $importLinks */
$this->set('importLinks', $importLinks);

/** @var array $withParams */
$this->set('withParams', $withParams);
?>
<div id="form-fields-container" class="row">
    <div class="col-lg-3 order-lg-last">
        <?= $this->load('modules/panels/index-actions', ['manager' => $manager]); ?>
    </div>

    <div class="col-lg-6 existing">
        <?= $this->load('modules/panels/index-existing', ['manager' => $manager]); ?>
    </div>

    <div class="col-lg-3 available order-lg-first">
        <?= $this->load('modules/panels/index-available', ['manager' => $manager]); ?>
    </div>
</div>
