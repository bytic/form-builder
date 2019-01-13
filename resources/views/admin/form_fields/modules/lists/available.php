<?php

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldTrait;

/** @var FormFieldsTrait $manager */
$manager = $this->manager;

$fields = $this->fields;

/** @var FormFieldTrait[] $fieldsRole */
/** @var string $role */
$fieldsRole = $fields[$role] + $fields['custom'];
?>
<ul id="fields-competitor" class='list-unstyled fields-container'>
    <?php foreach ($fieldsRole as $field) { ?>
        <li class="field">
            <span class="name">
                <?php echo $field->getLabel(); ?>
            </span>
            <div class="btn-group">
                <?php
                $addUrlParams = $this->withParams + ['type' => $field->getName(), 'role' => $role];
                $addUrl = $manager->compileURL('add', $addUrlParams);
                ?>
                <a href="<?php echo $addUrl; ?>" class="btn btn-success btn-xs pull-right">
                    +
                </a>
            </div>
        </li>
    <?php } ?>
</ul>  