document.addEventListener("DOMContentLoaded", function () {

    $("#form-fields-container ul.sortable").sortable({
        update: function (event, ui) {
            var order = $(this).sortable('serialize');

            $.ajax({
                url: $(this).data('url'),
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