function loadScriptIfRequired(selector, src) {
    if (document.querySelector(selector)) {
        const script = document.createElement("script");
        script.type = "text/javascript";
        script.src = src;
        document.head.appendChild(script);
    }
}

loadScriptIfRequired(
    "[toast-list]",
    "https://cdn.jsdelivr.net/npm/toastify-js"
);
loadScriptIfRequired(
    "[data-choices]",
    "https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/choices.min.js"
);
loadScriptIfRequired(
    "[data-provider]",
    "https://cdn.jsdelivr.net/npm/flatpickr"
);
