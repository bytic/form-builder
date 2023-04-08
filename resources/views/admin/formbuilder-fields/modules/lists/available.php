<?php

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use Nip\Records\RecordManager;

/** @var FormFieldsTrait|RecordManager $manager */
$manager = $this->manager;
?>
<ul class='list-unstyled fields-container'>
    <?php foreach ($fields as $field) { ?>
        <li class="field">
            <span class="name">
                <?= $field->getLabel(); ?>
            </span>
            <div class="btn-group">
                <?php
                $addUrlParams = $this->withParams + ['type' => $field->getName(), 'role' => $role];
                $addUrl = $manager->compileURL('add', $addUrlParams);
                ?>
                <a href="<?= $addUrl; ?>"
                   class="btn btn-success btn-xs pull-right add-<?= $field->getName(); ?>">
                    +
                </a>
            </div>
        </li>
    <?php } ?>
</ul>  