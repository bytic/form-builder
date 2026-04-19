import intlTelInput from 'intl-tel-input';

class FrontendPhoneInputs
{
    init()
    {
        const inputTels = document.querySelectorAll('input[type="tel"]');
        inputTels.forEach((input) => this.initializeInput(input));
    }

    initializeInput(input)
    {
        const iti = intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: (success, failure) => this.geoIpLookup(success, failure),
            separateDialCode: true,
            loadUtilsOnInit: () => import("intl-tel-input/utils")
        });

        const form = input.closest('form');
        if (form) {
            form.addEventListener('submit', () => {
                input.value = iti.getNumber(intlTelInput.utils.numberFormat.E164);
            });
        }
    }

    geoIpLookup(success, failure)
    {
        fetch("https://ipapi.co/json")
            .then((res) => res.json())
            .then((data) => success(data.country_code))
            .catch(() => failure());
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const phoneInputs = new FrontendPhoneInputs();
    phoneInputs.init();
});
