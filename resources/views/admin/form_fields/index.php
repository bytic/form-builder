<?php

/** @var \ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait $manager */
$this->set('manager', $manager);

/** @var array $roles */
$this->set('roles', $roles);

$this->set('fields', $fields);

/** @var array $importLinks */
$this->set('importLinks', $importLinks);

/** @var array $withParams */
$this->set('withParams', $withParams);
?>
<div id="form-fields-container" class="row">
    <div class="col-sm-3 available">
        <?php
        echo $this->load(
            'modules/panels/index-available'
        ); ?>
    </div>
    <div class="col-sm-7 existing">
        <?php
        echo $this->load(
            'modules/panels/index-existing'
        );
        ?>
    </div>
    <div class="col-sm-2">
        <?php
        echo $this->load(
            'modules/panels/index-actions'
        );
        ?>
    </div>
</div>
