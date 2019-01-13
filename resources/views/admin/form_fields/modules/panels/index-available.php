<?php
/** @var \ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait $manager */
$manager = $this->manager;

/** @var array $roles */
$roles = $this->roles;
?>
<?php foreach ($roles as $role) { ?>
    <div class="form-panel">
        <div class="header">
            <?php echo $manager->getLabel('available.'.$role) ?>
        </div>
        <div class="content">
            <?php echo $this->load('../lists/available', ['role' => $role]); ?>
        </div>
    </div>
<?php } ?>