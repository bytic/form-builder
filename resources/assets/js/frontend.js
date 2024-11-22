import intlTelInput from 'intl-tel-input';

const input = document.querySelector('input[type="tel"]');
intlTelInput(input, {
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