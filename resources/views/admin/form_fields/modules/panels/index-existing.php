<?php
/** @var \ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait $manager */
$manager = $this->manager;

/** @var array $roles */
$roles = $this->roles;
?>
<?php foreach ($roles as $role) { ?>
    <?php $fields = isset($this->fields['existing.' . $role]) ? $this->fields['existing.' . $role] : $this->fields['existing']; ?>
    <?php if ($fields) { ?>
        <div class="form-panel">
            <div class="header">
                <?php echo $manager->getLabel('existing.' . $role) ?>
            </div>
            <div class="fields-body">
                <?php
                echo $this->load(
                    '../lists/existing',
                    [
                        'fields' => $fields,
                        'updateUrl' => $manager->compileURL('order', $this->withParams)
                    ]
                ); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>