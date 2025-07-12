'use strict';

const loadStyle = (url) => {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = url;
    document.head.appendChild(link);
};

const loadScript = (url) => new Promise((resolve) => {
    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.onload = resolve;
    script.src = url;
    document.head.appendChild(script);
});

const ITI_CSS = "https://cdn.jsdelivr.net/npm/intl-tel-input/build/css/intlTelInput.min.css";
const ITI_JS = "https://cdn.jsdelivr.net/npm/intl-tel-input/build/js/intlTelInputWithUtils.min.js";
const initializedTelInputs = new WeakSet();

const initTelInput = (input, i = 0) => {
    if (initializedTelInputs.has(input)) return;
    initializedTelInputs.add(input);

    input.removeAttribute('placeholder');
    if (!input.id) input.id = `tel_${Date.now()}_${i}`;

    const iti = window.intlTelInput(input, {
        initialCountry: "us",
        preferredCountries: ['ua', 'ru', 'pl', 'us'],
        separateDialCode: true,
        autoPlaceholder: 'polite',
        placeholderNumberType: 'MOBILE',
        formatOnDisplay: true,
        nationalMode: true,
    });

    // --- Hidden Field logic ---
    let origName = input.name;
    if (!origName) {
        origName = `tel_${Date.now()}_${i}`;
    };

    // Add hidden input if not exists
    let hidden = input.parentNode.querySelector('input[type="hidden"][data-phone-hidden="1"]');
    if (!hidden) {
        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.setAttribute('name', origName);
        hidden.setAttribute('data-phone-hidden', '1');
        input.parentNode.insertBefore(hidden, input.nextSibling);
        input.removeAttribute('name');
    }

    // Update hidden on input and countrychange
    function updateHidden() {
        hidden.value = iti.getNumber() || '';
    }
    input.addEventListener('input', updateHidden);
    input.addEventListener('countrychange', updateHidden);
    // Update hidden at init
    updateHidden();
};

const telInitCallback = () => {
    document.querySelectorAll('input[type="tel"][name]').forEach((input, i) => {
    if (input.offsetParent !== null && !input.disabled) {
        initTelInput(input, i);
    }
    });
};

document.addEventListener('DOMContentLoaded', () => {
    loadStyle(ITI_CSS);
    loadScript(ITI_JS)
    .then(() => {
        telInitCallback();
        document.addEventListener('wpcf7init', telInitCallback);
        document.addEventListener('wpcf7mailsent', telInitCallback);
        const observer = new MutationObserver(() => telInitCallback());
        observer.observe(document.body, { childList: true, subtree: true });
    });
});