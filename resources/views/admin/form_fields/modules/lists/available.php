<?php

use KM42\Pacers\Models\Events\FormFields\FormFields;
use KM42\Pacers\Models\Events\FormFields\FormField;

/** @var FormField[] $fields */
$fields = $this->fields[$role] + $this->fields['custom'];
?>
<ul id="fields-competitor" class='list-unstyled fields-container'>
    <?php foreach ($fields as $field) { ?>
        <li class="field">
            <span class="name">
                <?php echo $field->getLabel(); ?>
            </span>
            <div class="btn-group">
                <?php $addUrl = FormFields::instance()->getAddURL([
                    'id_race' => $this->_race->id,
                    'type' => $field->getName(),
                    'role' => $role
                ]) ?>
                <a href="<?php echo $addUrl; ?>" class="btn btn-success btn-xs pull-right">
                    +
                </a>
            </div>
        </li>
    <?php } ?>
</ul>  