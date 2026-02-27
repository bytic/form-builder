document.addEventListener("DOMContentLoaded", function () {

    // ── Toast colour tokens (match CSS custom properties) ───────────────────
    var TOAST_COLORS = {
        error:   "#ef4444",
        success: "#22c55e",
        info:    "#3b82f6"
    };

    // ── Sortable drag-and-drop ──────────────────────────────────────────────
    $("#form-fields-container .sortable").sortable({
        placeholder: "ui-sortable-placeholder",
        forcePlaceholderSize: true,
        opacity: 0.85,
        revert: 120,

        start: function (event, ui) {
            ui.placeholder.height(ui.item.outerHeight());
            ui.item.closest(".fields-container").addClass("fb-drag-over");
        },

        stop: function (event, ui) {
            ui.item.closest(".fields-container").removeClass("fb-drag-over");
        },

        update: function (event, ui) {
            var $list = $(this);
            $list.removeClass("fb-drag-over");
            var order = $list.sortable("serialize");

            $.ajax({
                url: $list.data("url"),
                type: "post",
                data: { order: order },
                success: function (data) {
                    if (typeof jQuery.jGrowl === "function") {
                        jQuery.jGrowl(data.message, { life: 4000, theme: data.type });
                    } else {
                        fbToast(data.message, data.type);
                    }
                },
                error: function () {
                    fbToast("Could not save field order. Please try again.", "error");
                }
            });
        }
    });

    // ── Live search for available fields ────────────────────────────────────
    var $searchInput = $("#fb-field-search");
    if ($searchInput.length) {
        $searchInput.on("input", function () {
            var query = this.value.trim().toLowerCase();
            $("#fields-available .field").each(function () {
                var label = $(this).find(".field-name").text().toLowerCase();
                $(this).toggle(query === "" || label.includes(query));
            });
        });
    }

    // ── Minimal toast fallback (no jQuery.jGrowl) ────────────────────────────
    function fbToast(message, type) {
        var color = TOAST_COLORS[type] || TOAST_COLORS.info;
        var el = document.createElement("div");
        el.textContent = message;
        Object.assign(el.style, {
            position: "fixed", bottom: "1.5rem", right: "1.5rem", zIndex: 9999,
            background: color, color: "#fff", padding: ".75rem 1.25rem",
            borderRadius: ".5rem", boxShadow: "0 4px 12px rgba(0,0,0,.15)",
            fontSize: ".875rem", maxWidth: "320px", transition: "opacity .3s"
        });
        document.body.appendChild(el);
        setTimeout(function () {
            el.style.opacity = "0";
            setTimeout(function () { el.remove(); }, 300);
        }, 4000);
    }

});