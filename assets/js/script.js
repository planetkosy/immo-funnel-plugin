document.addEventListener('DOMContentLoaded', function () {
    updateProgressBar(1);
    document.getElementById('ort').addEventListener('input', validateTextInput);
    document.getElementById('plz').addEventListener('input', validatePostalCode);
    document.getElementById('weitere_info').addEventListener('input', validateTextAreaInput);
    document.getElementById('vorname').addEventListener('input', validateTextInput);
    document.getElementById('name').addEventListener('input', validateTextInput);
    document.getElementById('telefonnummer').addEventListener('input', validatePhoneNumber);
    const csrfToken = document.querySelector('input[name="csrf_token"]').value;
    console.log("Erstellter CSRF-Token (im HTML-Formular):", csrfToken);
});

document.addEventListener('DOMContentLoaded', () => {
    initSlider('grundstuecksgroesse_slider', 'grundstuecksgroesse_min', 'grundstuecksgroesse_max', 0, 5000, 5000, 50);
    initSlider('grundstuecksgroesse_mfh_slider', 'grundstuecksgroesse_mfh_min', 'grundstuecksgroesse_mfh_max', 0, 5000, 5000, 50);
    initSlider('wohnflaeche_slider', 'wohnflaeche_min', 'wohnflaeche_max', 0, 500, 500, 5);
    initSlider('wohnflaeche_etw_slider', 'wohnflaeche_etw_min', 'wohnflaeche_etw_max', 0, 500, 500, 5);
    initSlider('anzahlZimmer_slider', 'anzahlZimmer_min', 'anzahlZimmer_max', 0, 10, 10, 1);
    initSlider('anzahlZimmer_etw_slider', 'anzahlZimmer_etw_min', 'anzahlZimmer_etw_max', 0, 10, 10, 1);
    initSlider('wohneinheiten_slider', 'wohneinheiten_min', 'wohneinheiten_max', 0, 50, 50, 1);
    initSlider('grundstuecksgroesse_grundstueck_slider', 'grundstuecksgroesse_grundstueck_min', 'grundstuecksgroesse_grundstueck_max', 0, 5000, 5000, 50);
    initSlider('kaufpreis_mfh_slider', 'kaufpreis_mfh_min', 'kaufpreis_mfh_max', 0, 2000000, 2000000, 10000);
    initSlider('kaufpreis_slider', 'kaufpreis_min', 'kaufpreis_max', 0, 1000000, 1000000, 10000);
    initSlider('kaufpreis_grundstueck_slider', 'kaufpreis_grundstueck_min', 'kaufpreis_grundstueck_max', 0, 1000000, 1000000, 10000);
    initSlider('kaufpreis_etw_slider', 'kaufpreis_etw_min', 'kaufpreis_etw_max', 0, 1000000, 1000000, 10000);

    var radiusSlider = document.getElementById('radius_slider');
    noUiSlider.create(radiusSlider, {
        start: 0,
        connect: false,
        range: {
            'min': [0],
            'max': [50]
        },
        step: 1,
        tooltips: false,
    });

    radiusSlider.noUiSlider.on('update', function (values) {
        document.getElementById('radius_value').textContent = Math.round(values[0]) + ' km';
        validateStep5();
    });
})

let captchaToken = '';

document.addEventListener('DOMContentLoaded', function () {
    const privacyCheckbox = document.getElementById('datenschutz');
    const submitButton = document.getElementById('btnSubmit');
    const captchaHint = document.getElementById('captcha-hint'); 
    const container = document.getElementById('turnstile-container');
    let captchaValid = false;
    let privacyChecked = false;

    function toggleSubmitButton() {
        if (privacyChecked && captchaValid) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    privacyCheckbox.addEventListener('change', function () {
        privacyChecked = privacyCheckbox.checked;
        toggleSubmitButton();

        if (privacyChecked && !captchaValid) {
            captchaHint.style.display = 'block';
            if (!document.querySelector('.cf-turnstile iframe')) {
                container.innerHTML = '';
                window.turnstile.render(container, {
                    sitekey: immoFunnelConfig.turnstilePublicKey,
                    callback: function (token) {
                        console.log("CAPTCHA validiert, Token erhalten:", token);
						captchaToken = token;
                        captchaValid = true;
                        toggleSubmitButton();
                    },
                    error: function () {
                        console.log("Fehler beim Laden des CAPTCHA");
                    }
                });
            }
        } else {
            //captchaHint.style.display = 'none';
            //container.innerHTML = '';
            //captchaValid = false;
            toggleSubmitButton();
        }
    });

    toggleSubmitButton();
});

function initSlider(sliderId, minDisplayId, maxDisplayId, minValue, maxValue, sliderMax, step) {
    var slider = document.getElementById(sliderId);
    noUiSlider.create(slider, {
        start: [minValue, maxValue],
        connect: true,
        range: {
            'min': [0],
            'max': [sliderMax]
        },
        step: step,
        tooltips: false,
    });

    slider.noUiSlider.on('update', function (values, handle) {
        document.getElementById(minDisplayId).textContent = Math.round(values[0]).toLocaleString('de-DE');
        document.getElementById(maxDisplayId).textContent = Math.round(values[1]).toLocaleString('de-DE');
    });
}

function updateBackgroundColor() {
    var select = document.getElementById('effizienzklasse_efh_dhh_rh');
    var selectedOption = select.options[select.selectedIndex];
    select.style.backgroundColor = selectedOption.style.backgroundColor;
}

function updateProgressBar(step) {
    var progressBars = document.querySelectorAll('.step-progress');
    progressBars.forEach(function (bar, index) {
        if (index < step) {
            bar.classList.add('active');
        } else {
            bar.classList.remove('active');
        }
    });
}

function validateStep1() {
    var radioButtons = document.querySelectorAll('input[name="nutzung"]');
    var isChecked = Array.from(radioButtons).some(rb => rb.checked);
    document.getElementById('btnStep1').disabled = !isChecked;
}

function validateStep2() {
    var radioButtons = document.querySelectorAll('input[name="immobilie"]');
    var isChecked = Array.from(radioButtons).some(rb => rb.checked);
    document.getElementById('btnStep2').disabled = !isChecked;
    showStep3Details();
}

function validateStep3() {
    var immobilienwahl = document.querySelector('input[name="immobilie"]:checked')?.value;
    var allSlidersValid = false;

    if (immobilienwahl === 'efh' || immobilienwahl === 'dhh' || immobilienwahl === 'rh') {
        allSlidersValid = checkSliderValues('grundstuecksgroesse_slider') &&
            checkSliderValues('wohnflaeche_slider') &&
            checkSliderValues('anzahlZimmer_slider') &&
            checkSliderValues('kaufpreis_slider');
    } else if (immobilienwahl === 'etw') {
        allSlidersValid = checkSliderValues('wohnflaeche_etw_slider') &&
            checkSliderValues('anzahlZimmer_etw_slider') &&
            checkSliderValues('kaufpreis_etw_slider');
    } else if (immobilienwahl === 'mfh') {
        allSlidersValid = checkSliderValues('grundstuecksgroesse_mfh_slider') &&
            checkSliderValues('wohneinheiten_slider') &&
            checkSliderValues('kaufpreis_mfh_slider');
    } else if (immobilienwahl === 'grundstueck') {
        allSlidersValid = checkSliderValues('grundstuecksgroesse_grundstueck_slider') &&
            checkSliderValues('kaufpreis_grundstueck_slider');
    }

    document.getElementById('btnStep3').disabled = !allSlidersValid;
    showStep4Details();
}

function checkSliderValues(sliderId) {
    var slider = document.getElementById(sliderId);
    var values = slider.noUiSlider.get();
    return values[0] < values[1];
}

function showStep3Details() {
    var immobilienwahl = document.querySelector('input[name="immobilie"]:checked')?.value;

    document.querySelectorAll('.immobilien-details').forEach(el => el.style.display = 'none');
    if (immobilienwahl === 'efh' || immobilienwahl === 'dhh' || immobilienwahl === 'rh') {
        document.getElementById('efh_dhh_rh').style.display = 'block';
    } else if (immobilienwahl === 'etw') {
        document.getElementById('etw').style.display = 'block';
    } else if (immobilienwahl === 'mfh') {
        document.getElementById('mfh').style.display = 'block';
    } else if (immobilienwahl === 'grundstueck') {
        document.getElementById('grundstueck').style.display = 'block';
    }
    validateStep3();
}

function validateStep4() {
    var immobilienwahl = document.querySelector('input[name="immobilie"]:checked')?.value;
    if (immobilienwahl === 'efh' || immobilienwahl === 'dhh' || immobilienwahl === 'rh') {
        var radioButtons = document.querySelectorAll('input[name="energie_efh_dhh_rh"]');
        var isChecked = Array.from(radioButtons).some(rb => rb.checked);
        document.getElementById('btnStep4').disabled = !isChecked;
    } else if (immobilienwahl === 'etw') {
        var radioButtons = document.querySelectorAll('input[name="energie_etw"]');
        var isChecked = Array.from(radioButtons).some(rb => rb.checked);
        document.getElementById('btnStep4').disabled = !isChecked;
    } else if (immobilienwahl === 'mfh') {
        var radioButtons = document.querySelectorAll('input[name="energie_mfh"]');
        var isChecked = Array.from(radioButtons).some(rb => rb.checked);
        document.getElementById('btnStep4').disabled = !isChecked;
    } else if (immobilienwahl === 'grundstueck') {
        document.getElementById('btnStep4').disabled = false;
    }
}

function showStep4Details() {
    var immobilienwahl = document.querySelector('input[name="immobilie"]:checked')?.value;

    document.querySelectorAll('.immobilien-ausstattung').forEach(el => el.style.display = 'none');
    if (immobilienwahl === 'efh' || immobilienwahl === 'dhh' || immobilienwahl === 'rh') {
        document.getElementById('efh_dhh_rh_ausstattung').style.display = 'block';
    } else if (immobilienwahl === 'etw') {
        document.getElementById('etw_ausstattung').style.display = 'block';
    } else if (immobilienwahl === 'mfh') {
        document.getElementById('mfh_ausstattung').style.display = 'block';
    } else if (immobilienwahl === 'grundstueck') {
        document.getElementById('grundstueck_ausstattung').style.display = 'block';
    }
    validateStep4();
}

function validateStep5() {
    var plz = document.getElementById('plz').value;
    var ort = document.getElementById('ort').value;
    var isPlzValid = plz.length === 5;
    var isOrtValid = ort !== '';

    document.getElementById('btnStep5').disabled = !(isOrtValid && isPlzValid);
}

function validateStep7() {
    var requiredFields = ['vorname', 'name', 'email', 'telefonnummer'];
    var allFilled = requiredFields.every(id => document.getElementById(id).value.trim() !== '');

    var emailField = document.getElementById('email');
    var emailValid = isValidEmail(emailField.value.trim());

    document.getElementById('btnStep7').disabled = !allFilled || !emailValid;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function generateSummary() {
    const summary = document.getElementById('summary');

    // Nutzung
    const nutzung = document.querySelector('input[name="nutzung"]:checked') ? document.querySelector('input[name="nutzung"]:checked').value : 'Keine Angabe';

    // Immobilie
    const immobilie = document.querySelector('input[name="immobilie"]:checked') ? document.querySelector('input[name="immobilie"]:checked').value : 'Keine Angabe';
    const immobilieElement = document.querySelector('input[name="immobilie"]:checked');
    const immobilie_klar = immobilieElement ? immobilieElement.closest('label').querySelector('span').textContent : 'Keine Angabe';

    // Weitere Details
    let grundstuecksgroesse = document.getElementById('grundstuecksgroesse_min') ? document.getElementById('grundstuecksgroesse_min').textContent + ' - ' + document.getElementById('grundstuecksgroesse_max').textContent + ' m²' : 'Keine Angabe';
    let wohnflaeche = document.getElementById('wohnflaeche_min') ? document.getElementById('wohnflaeche_min').textContent + ' - ' + document.getElementById('wohnflaeche_max').textContent + ' m²' : 'Keine Angabe';
    let anzahlZimmer = document.getElementById('anzahlZimmer_min') ? document.getElementById('anzahlZimmer_min').textContent + ' - ' + document.getElementById('anzahlZimmer_max').textContent : 'Keine Angabe';
    let grundstuecksgroesse_mfh = document.getElementById('grundstuecksgroesse_mfh_min') ? document.getElementById('grundstuecksgroesse_mfh_min').textContent + ' - ' + document.getElementById('grundstuecksgroesse_mfh_max').textContent + ' m²' : 'Keine Angabe';
    let grundstuecksgroesse_grundstueck = document.getElementById('grundstuecksgroesse_grundstueck_min') ? document.getElementById('grundstuecksgroesse_grundstueck_min').textContent + ' - ' + document.getElementById('grundstuecksgroesse_grundstueck_max').textContent + ' m²' : 'Keine Angabe';
    let wohnflaeche_etw = document.getElementById('wohnflaeche_etw_min') ? document.getElementById('wohnflaeche_etw_min').textContent + ' - ' + document.getElementById('wohnflaeche_etw_max').textContent + ' m²' : 'Keine Angabe';
    let anzahlZimmer_etw = document.getElementById('anzahlZimmer_etw_min') ? document.getElementById('anzahlZimmer_etw_min').textContent + ' - ' + document.getElementById('anzahlZimmer_etw_max').textContent : 'Keine Angabe';
    let wohneinheiten = document.getElementById('wohneinheiten_min') ? document.getElementById('wohneinheiten_min').textContent + ' - ' + document.getElementById('wohneinheiten_max').textContent : 'Keine Angabe';
    let kaufpreis = document.getElementById('kaufpreis_min') ? document.getElementById('kaufpreis_min').textContent + ' - ' + document.getElementById('kaufpreis_max').textContent + ' €' : 'Keine Angabe';
    let kaufpreis_etw = document.getElementById('kaufpreis_etw_min') ? document.getElementById('kaufpreis_etw_min').textContent + ' - ' + document.getElementById('kaufpreis_etw_max').textContent + ' €' : 'Keine Angabe';
    let kaufpreis_mfh = document.getElementById('kaufpreis_mfh_min') ? document.getElementById('kaufpreis_mfh_min').textContent + ' - ' + document.getElementById('kaufpreis_mfh_max').textContent + ' €' : 'Keine Angabe';
    let kaufpreis_grundstueck = document.getElementById('kaufpreis_grundstueck_min') ? document.getElementById('kaufpreis_grundstueck_min').textContent + ' - ' + document.getElementById('kaufpreis_grundstueck_max').textContent + ' €' : 'Keine Angabe';

    // Suchregion
    const plz = document.getElementById('plz').value || 'Keine Angabe';
    const ort = document.getElementById('ort').value || 'Keine Angabe';
    const radius = document.getElementById('radius_value').textContent || 'Keine Angabe';

    // Weitere Informationen
    const weitereInfo = document.getElementById('weitere_info').value || 'Keine Angabe';

    // Kontaktdaten
    const vorname = document.getElementById('vorname').value || 'Keine Angabe';
    const name = document.getElementById('name').value || 'Keine Angabe';
    const email = document.getElementById('email').value || 'Keine Angabe';
    const telefonnummer = document.getElementById('telefonnummer').value || 'Keine Angabe';

    let merkmale = '';

    if (immobilie === 'efh' || immobilie === 'dhh' || immobilie === 'rh') {
        const effizienzklasse = document.querySelector('input[name="energie_efh_dhh_rh"]:checked') ? document.querySelector('input[name="energie_efh_dhh_rh"]:checked').value : 'Keine Angabe';
        merkmale += `<p class="custom-summary"><strong>Energieeffizienzklasse:</strong> ${effizienzklasse}</p>`;

        const checkboxIds = ['efh_dhh_rh_bungalow', 'efh_dhh_rh_keller', 'efh_dhh_rh_garage', 'efh_dhh_rh_carport', 'efh_dhh_rh_kamin', 'efh_dhh_rh_fussheizung', 'efh_dhh_rh_gaestewc', 'efh_dhh_rh_badfenster', 'efh_dhh_rh_pool'];

        checkboxIds.forEach(id => {
            const checkbox = document.getElementById(id);
            if (checkbox.checked) {
                const label = document.querySelector(`label[for="${id}"]`);
                console.log(label);

                const labelText = label ? label.textContent : 'Unbekanntes Merkmal';

                merkmale += `<p class="custom-summary"><strong>${labelText}:</strong> Ja</p>`;
            }
        });
    }

    if (immobilie === 'etw') {
        const effizienzklasse = document.querySelector('input[name="energie_etw"]:checked') ? document.querySelector('input[name="energie_etw"]:checked').value : 'Keine Angabe';
        merkmale += `<p class="custom-summary"><strong>Energieeffizienzklasse:</strong> ${effizienzklasse}</p>`;

        const checkboxIds = ['etw_balkon', 'etw_terrasse', 'etw_gartenanteil', 'etw_stellplatz', 'etw_tgstellplatz', 'etw_badfenster', 'etw_gaestewc', 'etw_fussheizung', 'etw_abstellraum'];
        checkboxIds.forEach(id => {
            const checkbox = document.getElementById(id);
            if (checkbox.checked) {
                const label = document.querySelector(`label[for="${id}"]`);
                console.log(label);
                const labelText = label ? label.textContent : 'Unbekanntes Merkmal';

                merkmale += `<p class="custom-summary"><strong>${labelText}:</strong> Ja</p>`;
            }
        });
    }

    if (immobilie === 'mfh') {
        const effizienzklasse = document.querySelector('input[name="energie_mfh"]:checked') ? document.querySelector('input[name="energie_mfh"]:checked').value : 'Keine Angabe';
        merkmale += `<p class="custom-summary"><strong>Energieeffizienzklasse:</strong> ${effizienzklasse}</p>`;

        const checkboxIds = ['mfh_tg', 'mfh_garage', 'mfh_stellplatz', 'mfh_voll', 'mfh_leer', 'mfh_sanierung'];
        checkboxIds.forEach(id => {
            const checkbox = document.getElementById(id);
            if (checkbox.checked) {
                const label = document.querySelector(`label[for="${id}"]`);
                console.log(label);

                const labelText = label ? label.textContent : 'Unbekanntes Merkmal';

                merkmale += `<p class="custom-summary"><strong>${labelText}:</strong> Ja</p>`;
            }
        });
    }

    if (immobilie === 'grundstueck') {
        const checkboxIds = ['gs_baugrundstueck', 'gs_bauerwartungsland', 'gs_neubausiedlung', 'gs_bautraeger', 'gs_erschlossen', 'gs_sonstiges'];
        checkboxIds.forEach(id => {
            const checkbox = document.getElementById(id);
            if (checkbox.checked) {
                const label = document.querySelector(`label[for="${id}"]`);
                console.log(label);

                const labelText = label ? label.textContent : 'Unbekanntes Merkmal';

                merkmale += `<p class="custom-summary"><strong>${labelText}:</strong> Ja</p>`;
            }
        });
    }

    summary.innerHTML = `
<h3>Kontaktdaten</h3>
<div class="text-group">
<p class="custom-summary"><strong>Vorname:</strong> ${vorname}</p>
<p class="custom-summary"><strong>Nachname:</strong> ${name}</p>
<p class="custom-summary"><strong>E-Mail:</strong> ${email}</p>
<p class="custom-summary"><strong>Telefonnummer:</strong> ${telefonnummer}</p>
</div>    
<h3>Nutzung und Art</h3>
<div class="text-group">    
<p class="custom-summary"><strong>Nutzung:</strong> ${nutzung}</p>
<p class="custom-summary"><strong>Immobilienart:</strong> ${immobilie_klar}</p>
</div>
<h3>Details</h3>
<div class="text-group">
${immobilie === 'efh' || immobilie === 'dhh' || immobilie === 'rh' ? `
    <p class="custom-summary"><strong>Grundstücksgröße:</strong> ${grundstuecksgroesse}</p>
    <p class="custom-summary"><strong>Wohnfläche:</strong> ${wohnflaeche}</p>
    <p class="custom-summary"><strong>Anzahl Zimmer:</strong> ${anzahlZimmer}</p>
    <p class="custom-summary"><strong>Kaufpreis:</strong> ${kaufpreis}</p>
` : ''}
${immobilie === 'mfh' ? `
    <p class="custom-summary"><strong>Grundstücksgröße:</strong> ${grundstuecksgroesse_mfh}</p>
    <p class="custom-summary"><strong>Anzahl Wohneinheiten:</strong> ${wohneinheiten}</p>
    <p class="custom-summary"><strong>Kaufpreis:</strong> ${kaufpreis_mfh}</p>
` : ''}
${immobilie === 'etw' ? `
    <p class="custom-summary"><strong>Wohnfläche:</strong> ${wohnflaeche_etw}</p>
    <p class="custom-summary"><strong>Anzahl Zimmer:</strong> ${anzahlZimmer_etw}</p>
    <p class="custom-summary"><strong>Kaufpreis:</strong> ${kaufpreis_etw}</p>
` : ''}
${immobilie === 'grundstueck' ? `
    <p class="custom-summary"><strong>Grundstücksgröße:</strong> ${grundstuecksgroesse_grundstueck}</p>
    <p class="custom-summary"><strong>Kaufpreis:</strong> ${kaufpreis_grundstueck}</p>
` : ''}
</div>
<h3>Ausstattungsmerkmale</h3>
<div class="text-group">
${merkmale}
</div>
<h3>Suchradius</h3>
<div class="text-group">
<p class="custom-summary"> ${plz}, ${ort}, Umkreis: ${radius}</p>
</div>
<h3>Weitere Informationen</h3>
<div class="text-group">
<p class="custom-summary"> ${weitereInfo}</p>
</div>
`;
}

function validatePostalCode(event) {
    const input = event.target;
    const regex = /^[0-9]*$/;

    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }

    if (input.value.length > 5) {
        input.value = input.value.substring(0, 5);
    }
}

function validateTextInput(event) {
    const regex = /^[a-zA-Z0-9äöüÄÖÜß\.\-\/\s]*$/;
    const input = event.target;

    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^a-zA-Z0-9äöüÄÖÜß\.\-\/\s]/g, '');
    }
}

function validateTextAreaInput(event) {
    const regex = /^[a-zA-Z0-9äöüÄÖÜß\.\-\/\(\)\:\_\!\?\*\,\+\%\=\s\n]*$/;
    const input = event.target;

    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^a-zA-Z0-9äöüÄÖÜß\.\-\/\(\)\:\_\!\?\*\,\+\%\=\s\n]/g, '');
    }
}

function validateEmail(event) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const input = event.target;

    if (!regex.test(input.value)) {
        console.log('Bitte eine gültige E-Mail-Adresse eingeben');
    }
}

function validatePhoneNumber(event) {
    const regex = /^[0-9+\-\/\(\)]*$/;
    const input = event.target;

    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^0-9+\-\/\(\)]/g, '');
    }
}

function nextStep(currentStep) {
    document.getElementById('step' + currentStep).classList.remove('active');
    document.getElementById('step' + (currentStep + 1)).classList.add('active');
    updateProgressBar(currentStep + 1);
    if (currentStep === 7) {
        generateSummary();
    } else if (currentStep === 2) {
        validateStep2();
    }
}

function prevStep(currentStep) {
    if (currentStep === 2 || currentStep === 3) {
        var radios = document.querySelectorAll('#step' + (currentStep - 1) + ' input[type="radio"]');
        radios.forEach(function (radio) {
            radio.checked = false;
        });
        document.getElementById('step' + currentStep).classList.remove('active');
        document.getElementById('step' + (currentStep - 1)).classList.add('active');
        updateProgressBar(currentStep - 1);
    } else {
        document.getElementById('step' + currentStep).classList.remove('active');
        document.getElementById('step' + (currentStep - 1)).classList.add('active');
        updateProgressBar(currentStep - 1);
    }
}

function submitForm() {
    document.getElementById('step8').classList.remove('active');
    document.getElementById('thankyou').classList.add('active');
}

function updateCharCount() {
    var textarea = document.getElementById('weitere_info');
    var charCount = document.getElementById('char-count');
    var maxLength = textarea.getAttribute('maxlength');
    var currentLength = textarea.value.length;
    var remaining = maxLength - currentLength;
    charCount.textContent = 'Verbleibende Zeichen: ' + remaining;
}

jQuery(document).ready(function () {
    jQuery('#immo-funnel').on('submit', function (e) {
        e.preventDefault();

        const summaryContent = jQuery('#summary').html();

        let formData = jQuery(this).serialize();
        const csrfToken = jQuery('input[name="csrf_token"]').val();
        console.log("Übermittelter CSRF-Token (AJAX):", csrfToken);
        formData += '&summary=' + encodeURIComponent(summaryContent) +
                    '&csrf_token=' + csrfToken +
                    '&cf-turnstile-response=' + encodeURIComponent(captchaToken);

        jQuery.ajax({
            url: immoFunnelAjax.ajaxUrl,
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log("Server-Antwort:", response);

                // Status in der Antwort überprüfen
                console.log("Status der Antwort:", response.status);

                // Prüfe den Status der Antwort
                if (response.status === 'success') {
                    // Wenn erfolgreich, thank-you-Seite anzeigen
                    jQuery('#step8').removeClass('active');
                    jQuery('#thankyou').addClass('active');
                } else if (response.status === 'error') {
                    // Bei Fehler die entsprechende Fehlermeldung anzeigen
                    console.log('Fehler:', response.message);
                    jQuery('#step8').removeClass('active');
                    jQuery('#error-send-mail').addClass('active');
                }
            },
            error: function (xhr, response) {
                console.log('Fehler beim AJAX-Request:', xhr.responseText);
                jQuery('#step8').removeClass('active');
                jQuery('#error-send-mail').addClass('active');
            }
        });
    });
});
