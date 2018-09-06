<?php
/** @var \KM42\Pacers\Models\Events\FormFields\FormFields $manager */
$manager = $this->modelManager;
?>
<?php foreach (['pacer'] as $role) { ?>
    <div class="form-panel">
        <div class="header">
            <?php echo $manager->getLabel('available.'.$role) ?>
        </div>
        <div class="content">
            <?php echo $this->load('../lists/available', ['role' => $role]); ?>
        </div>
    </div>
<?php } ?>