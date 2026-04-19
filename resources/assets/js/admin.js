class FormBuilderAdminUI
{
    init()
    {
        this.initSortable();
        this.initMoveButtons();
        this.initLiveSearch();
    }

    initSortable()
    {
        $("#form-fields-container .sortable").sortable({
            placeholder: "ui-sortable-placeholder",
            forcePlaceholderSize: true,
            opacity: 0.85,
            revert: 120,
            start: (event, ui) => {
                ui.placeholder.height(ui.item.outerHeight());
                ui.item.closest(".fields-container").addClass("fb-drag-over");
            },
            stop: (event, ui) => {
                ui.item.closest(".fields-container").removeClass("fb-drag-over");
            },
            update: (event) => {
                const $list = $(event.currentTarget);
                this.persistSortableOrder($list);
            }
        });
    }

    persistSortableOrder($list)
    {
        $list.removeClass("fb-drag-over");
        const order = $list.sortable("serialize");

        $.ajax({
            url: $list.data("url"),
            type: "post",
            data: {order},
            success: (data) => this.notify(data.message, data.type),
            error: () => this.notify("Could not save field order. Please try again.", "error")
        });
    }

    initLiveSearch()
    {
        const $searchInput = $("#fb-field-search");
        if (!$searchInput.length) {
            return;
        }

        $searchInput.on("input", (event) => {
            const query = event.currentTarget.value.trim().toLowerCase();
            this.filterAvailableFields(query);
        });
    }

    initMoveButtons()
    {
        $(document).on("click", "#form-fields-container .field-move", (event) => {
            event.preventDefault();

            const $button = $(event.currentTarget);
            const direction = $button.data("direction");
            const $field = $button.closest(".field");
            const $list = $field.closest(".sortable");
            const $target = direction === "up" ? $field.prev(".field") : $field.next(".field");

            if (!$target.length) {
                return;
            }

            if (direction === "up") {
                $field.insertBefore($target);
            } else {
                $field.insertAfter($target);
            }

            this.persistSortableOrder($list);
        });
    }

    filterAvailableFields(query)
    {
        $("#fields-available .field").each(function () {
            const label = $(this).find(".field-name").text().toLowerCase();
            $(this).toggle(query === "" || label.includes(query));
        });
    }

    notify(message, type = "info")
    {
        if (typeof jQuery.jGrowl === "function") {
            jQuery.jGrowl(message, {life: 4000, theme: type});
            return;
        }

        this.renderToast(message, type);
    }

    renderToast(message, type)
    {
        const el = document.createElement("div");
        el.textContent = message;
        Object.assign(el.style, {
            position: "fixed",
            bottom: "1.5rem",
            right: "1.5rem",
            zIndex: 9999,
            background: FormBuilderAdminUI.getToastColor(type),
            color: "var(--bs-white, #fff)",
            padding: ".75rem 1.25rem",
            borderRadius: "var(--bs-border-radius, .5rem)",
            boxShadow: "var(--bs-box-shadow, 0 4px 12px rgba(0,0,0,.15))",
            fontSize: ".875rem",
            maxWidth: "320px",
            transition: "opacity .3s"
        });

        document.body.appendChild(el);
        setTimeout(() => {
            el.style.opacity = "0";
            setTimeout(() => el.remove(), 300);
        }, 4000);
    }

    static getToastColor(type)
    {
        // Map type names to Bootstrap 5 CSS custom properties so the toast
        // colour automatically tracks the active theme.
        const map = {
            error:   "var(--bs-danger,  #dc3545)",
            success: "var(--bs-success, #198754)",
            info:    "var(--bs-info,    #0dcaf0)"
        };

        return map[type] || map.info;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const ui = new FormBuilderAdminUI();
    ui.init();
});
