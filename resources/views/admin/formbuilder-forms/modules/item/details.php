<?php

/** @var \ByTIC\FormBuilder\Models\Forms\Form $item */

use ByTIC\FormBuilder\Utility\FormsBuilderModels;

$item = $item ?? $this->item;

?>
<table class="details table table-striped">
    <tbody>
    <tr>
        <td class="name">
            <?php echo FormsBuilderModels::forms()->getLabel('title.singular'); ?>:
        </td>
        <td class="value">
            <a href="<?php echo $item->getURL(); ?>">
                <?php echo $item->getName(); ?>
            </a>
        </td>
    </tr>
    <tr>
        <td class="name">
            <?php echo translator()->trans('modified'); ?>:
        </td>
        <td class="value">
            <?php echo $item->modified; ?>
        </td>
    </tr>
    <tr>
        <td class="name"><?php echo translator()->trans('created'); ?>:</td>
        <td class="value">
            <?php echo $item->created; ?>
        </td>
    </tr>
    </tbody>
</table>
