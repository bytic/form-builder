<?php
/** @var FormFieldsTrait $manager */

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner;

$manager = $this->manager;

/** @var FormFieldsDesigner $designer */
$designer = $this->designer;

/** @var array $roles */
$roles = $this->fieldsRoles ?? $designer->getRoles();
?>

<div class="d-grid gap-3">
    <?php foreach ($roles as $role) { ?>
        <?php
        $fields = $designer->getExisting($role)->all();
        ?>
        <?php if ($fields) { ?>
            <div class="form-panel">
                <div class="header">
                    <?= $manager->getLabel('existing.'.$role) ?>
                </div>
                <div class="fields-body">
                    <?= $this->load(
                        '../lists/existing',
                        [
                            'fields' => $fields,
                            'updateUrl' => $this->formBuilder->compileURL('order', $this->withParams),
                        ]
                    ); ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
