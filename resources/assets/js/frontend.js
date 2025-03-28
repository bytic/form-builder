import intlTelInput from 'intl-tel-input';

const inputTels = document.querySelectorAll('input[type="tel"]');
inputTels.forEach(function (input) {
    const iti = intlTelInput(input, {
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
        separateDialCode: true,
        loadUtilsOnInit: () => import("intl-tel-input/utils")
    });
    var form = input.closest('form');
    if (form) {
        form.addEventListener('submit', function () {
            input.value = iti.getNumber(intlTelInput.utils.numberFormat.E164);
        });
    }
});
