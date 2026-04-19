<?php

use ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait;
use Nip\Records\AbstractModels\RecordManager;

/** @var FormFieldsTrait|RecordManager $manager */
$manager = $this->manager;

/** @var array $roles */
$roles = $this->roles;
?>
<div class="fb-actions-panel">
    <div class="card">
        <div class="card-header">
            <?= translator()->trans('actions') ?? 'Actions'; ?>
        </div>
        <div class="card-body">
            <?php if (!empty($this->importLinks)) { ?>
                <div class="dropdown w-100">
                    <a class="btn btn-outline-primary dropdown-toggle w-100" data-bs-toggle="dropdown" href="#">
                        <i class="fas fa-file-import me-1"></i>
                        <?= translator()->trans('form-builder.import') ?? 'Import from'; ?>
                    </a>
                    <ul class="dropdown-menu w-100">
                        <?php foreach ($this->importLinks as $link) { ?>
                            <li>
                                <a href="<?= $link['href']; ?>" class="dropdown-item">
                                    <?= htmlspecialchars((string)$link['name']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <form method="post"
                  action="<?= $this->formBuilder->compileURL('reset', $this->withParams); ?>"
                  onsubmit="return confirm('<?= translator()->trans('general.messages.confirm'); ?>');">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-undo me-1"></i>
                    <?= $manager->getLabel('reset-form'); ?>
                </button>
            </form>
        </div>
    </div>
</div>