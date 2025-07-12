'use strict';

// Helper: dynamically load CSS file
const loadStyle = (url) => {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = url;
    document.head.appendChild(link);
};

// Helper: dynamically load JS file, sequentially
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

    // Remove placeholder attribute to allow autoPlaceholder
    input.removeAttribute('placeholder');

    // Ensure unique ID
    if (!input.id) input.id = `tel_${Date.now()}_${i}`;

    // Initialize intl-tel-input
    window.intlTelInput(input, {
        initialCountry: "us", // Default country
        preferredCountries: ['ua', 'ru', 'pl', 'us'],
        separateDialCode: true,
        autoPlaceholder: 'polite',
        placeholderNumberType: 'MOBILE',
        formatOnDisplay: true,
        nationalMode: true,
    });
};

// Universal init (wait for fields)
const telInitCallback = () => {
    document.querySelectorAll('input[type="tel"]').forEach((input, i) => {
        // Only visible and enabled fields
        if (input.offsetParent !== null && !input.disabled) {
            initTelInput(input, i);
        }
    });
};

document.addEventListener('DOMContentLoaded', () => {
    // Load CSS
    loadStyle(ITI_CSS);

    // First load intl-tel-input, then utils.js, then initialize fields
    loadScript(ITI_JS)
        .then(() => {
            // Init for already existing fields
            telInitCallback();

            // For dynamically added fields (CF7, AJAX, etc)
            document.addEventListener('wpcf7init', telInitCallback);
            document.addEventListener('wpcf7mailsent', telInitCallback);

            // General MutationObserver fallback (e.g., AJAX)
            const observer = new MutationObserver(() => telInitCallback());
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        });
});