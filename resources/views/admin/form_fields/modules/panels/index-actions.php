<?php
/** @var \KM42\Pacers\Models\Events\FormFields\FormFields $manager */
$manager = $this->modelManager;
?>
<div class="btn-group">
    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
        Importa de la
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <?php foreach ($this->races as $race) { ?>
            <?php if ($this->_race->id != $race->id) { ?>
                <li>
                    <a href="<?php echo $manager->compileURL('importFromEvent',
                        ['id_race' => $this->_race->id, 'from_race' => $race->id]); ?>"
                    >
                        <?php echo $race->getName(); ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<p>&nbsp;</p>
<form method="post"
      action="<?php echo $manager->compileURL('reset', ['id_event' => $this->_event->id]); ?>"
      onsubmit="return confirm('<?php echo translator()->trans('general.messages.confirm'); ?>');">
    <button type="submit" class="btn btn-danger">
        <?php echo $manager->getLabel('reset-race'); ?>
    </button>
</form>