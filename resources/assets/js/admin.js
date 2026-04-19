class FormBuilderAdminUI
{
    init()
    {
        this.initSortable();
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
            color: "#fff",
            padding: ".75rem 1.25rem",
            borderRadius: ".5rem",
            boxShadow: "0 4px 12px rgba(0,0,0,.15)",
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
        const toastColors = {
            error: "#ef4444",
            success: "#22c55e",
            info: "#3b82f6"
        };

        return toastColors[type] || toastColors.info;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const ui = new FormBuilderAdminUI();
    ui.init();
});
