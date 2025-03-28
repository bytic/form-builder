const inputTels = document.querySelector('input[type="tel"]');
inputTels.forEach(input => function () {
    window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: function (success, failure) {
            fetch("https://ipapi.co/json")
                .then(function (res) {
                    return res.json();
                })
                .then(function (data) {
                    success(data.country_code);
                })
                .catch(function () {
                    failure();
                });
        },
        loadUtilsOnInit: () => import("intl-tel-input/utils")
    });
    var form = input.closest('form');
    if (form) {
        form.addEventListener('submit', function () {
            input.value = input.getNumber();
        });
    }
});
