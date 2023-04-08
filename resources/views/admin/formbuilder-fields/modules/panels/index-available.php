<?php
/** @var FormFieldsTrait $manager */

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use ByTIC\FormBuilder\FormFields\Dto\FormFieldsDesigner;

$manager = $this->manager;

/** @var FormFieldsDesigner $designer */
$designer = $this->designer;

/** @var array $roles */
$roles = $designer->getRoles();
?>

<div class="form-panel">
    <div class="header">
        <?= $manager->getLabel('available'); ?>
    </div>
    <div class="fields-body">
        <div id="fields-available" class='fields-container accordion'>
            <?php foreach ($roles

            as $role) { ?>
            <?php
            $fields = $designer->getAvailable($role);
            $id = 'fields-available-'.$role;
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#<?= $id; ?>" aria-expanded="true" aria-controls="<?= $id; ?>">
                        <?= $this->consumer->getManager()->getLabel('forms.role.'.$role) ?>
                    </button>
                </h2>
                <div id="<?= $id; ?>" class="accordion-collapse collapse show" data-bs-parent="#fields-available">
                    <div class="accordion-body">
                        <?= $this->load('../lists/available', ['fields' => $fields, 'role' => $role]); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
