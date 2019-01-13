<?php
/** @var \ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait $manager */
$manager = $this->manager;

/** @var array $roles */
$roles = $this->roles;
?>
<?php foreach (['pacer'] as $role) { ?>
    <?php if ($this->fields['existing.' . $role]) { ?>
        <div class="form-panel">
            <div class="header">
                <?php echo $manager->getLabel('existing.' . $role) ?>
            </div>
            <div class="content">
                <?php
                echo $this->load(
                    '../lists/existing',
                    [
                        'fields' => $this->fields['existing.' . $role],
                        'updateUrl' => $manager->compileURL('order', $this->withParams)
                    ]
                ); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>