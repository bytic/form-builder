<?php
/** @var \ByTIC\FormBuilder\Application\Models\Fields\Traits\FormFieldsTrait $manager */
$manager = $this->manager;

/** @var array $roles */
$roles = $this->roles;
?>
<div class="btn-group">
    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
        Importa de la
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <?php foreach ($this->importLinks as $link) { ?>
            <li>
                <a href="<?php echo $link['href']; ?>">
                    <?php echo $link['name']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>

<p>&nbsp;</p>

<form method="post"
      action="<?php echo $manager->compileURL('reset', $this->withParams); ?>"
      onsubmit="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
    <button type="submit" class="btn btn-danger">
        <?php echo $manager->getLabel('reset-race'); ?>
    </button>
</form>