<?php

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;

/** @var FormFieldsTrait $manager */
$manager = $this->manager;

/** @var array $roles */
$roles = $this->roles;
?>
<div class="btn-group">
    <a class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" href="#">
        Importa de la
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <?php foreach ($this->importLinks as $link) { ?>
            <li>
                <a href="<?= $link['href']; ?>">
                    <?= $link['name']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>

<p>&nbsp;</p>

<form method="post"
      action="<?= $manager->compileURL('reset', $this->withParams); ?>"
      onsubmit="return confirm('<?= translator()->trans('general.messages.confirm'); ?>');">
    <button type="submit" class="btn btn-danger">
        <?= $manager->getLabel('reset-race'); ?>
    </button>
</form>