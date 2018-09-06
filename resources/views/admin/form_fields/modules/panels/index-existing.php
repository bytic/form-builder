<?php
/** @var \KM42\Pacers\Models\Events\FormFields\FormFields $manager */
$manager = $this->modelManager;
?>
<?php foreach (['pacer'] as $role) { ?>
    <?php if ($this->fields['existing.'.$role]) { ?>
        <div class="form-panel">
            <div class="header">
                <?php echo $manager->getLabel('existing.'.$role) ?>
            </div>
            <div class="content">
                <?php echo $this->load('../lists/existing', ['fields' => $this->fields['existing.'.$role]]); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>


<script type="text/javascript">
    $(function () {
        $("#form-fields-container ul.sortable").sortable({
            update: function (event, ui) {
                var order = $(this).sortable('serialize');

                $.ajax({
                    url: '<?php echo $manager->getOrderURL(['id_event' => $this->_event->id]); ?>',
                    type: 'post',
                    data: {
                        'order': order
                    },
                    success: function (data) {
                        jQuery.jGrowl(data.message, {life: 10000, theme: data.type});
                    }
                });
            }
        });
    });
</script>