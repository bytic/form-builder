<?php

use ByTIC\FormBuilder\FormFields\Models\FormFields\FormFieldsTrait;

/** @var FormFieldsTrait $manager */

$this->set('manager', $manager);

/** @var array $importLinks */
$this->set('importLinks', $importLinks);

/** @var array $withParams */
$this->set('withParams', $withParams);
?>
<div id="form-fields-container" class="row g-3">

    <?php /* Available field types — left sidebar */ ?>
    <div class="col-lg-3 available order-lg-first">
        <div class="fb-sticky-sidebar">
            <?= $this->load('modules/panels/index-available', ['manager' => $manager]); ?>
        </div>
    </div>

    <?php /* Existing (active) fields — centre */ ?>
    <div class="col-lg-6 existing">
        <?= $this->load('modules/panels/index-existing', ['manager' => $manager]); ?>
    </div>

    <?php /* Actions — right sidebar */ ?>
    <div class="col-lg-3 order-lg-last">
        <div class="fb-sticky-sidebar">
            <?= $this->load('modules/panels/index-actions', ['manager' => $manager]); ?>
        </div>
    </div>

</div>
