// Funktion zur separaten Iconauswahl je Button aus der Mediathek
jQuery(document).ready(function ($) {
    $('.immo-funnel-upload-button').on('click', function (e) {
        e.preventDefault();

        var button = $(this); // Aktuell geklickter Button
        var fieldId = button.data('field'); // Dynamische Feld-ID
        
        // Verhindern, dass immer der gleiche Uploader verwendet wird
        wp.media({
            title: 'Icon auswählen',
            button: {
                text: 'Icon verwenden'
            },
            multiple: false
        }).on('select', function () {
            var attachment = wp.media.frame.state().get('selection').first().toJSON();
            
            // Eingabefeld und Vorschau für das korrekte Feld aktualisieren
            $('#' + fieldId).val(attachment.url);
            $('#' + fieldId + '_preview').attr('src', attachment.url);
        }).open();
    });
});

// Funktion zur Reiteranzeige auf der Einstellungsseite
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.nav-tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            tabs.forEach(t => t.classList.remove('nav-tab-active'));
            tab.classList.add('nav-tab-active');

            contents.forEach(content => content.style.display = 'none');
            document.querySelector(tab.getAttribute('href')).style.display = 'block';
        });
    });

    // Standardmäßig den ersten Tab anzeigen
    if (tabs.length > 0) {
        tabs[0].classList.add('nav-tab-active');
        contents[0].style.display = 'block';
    }
});


// Funktion zum speichern der Emailvorlage auf der Einstellungsseite
jQuery(document).ready(function ($) {
    $('#save-email-template').on('click', function () {
        // Den Inhalt des Editors abrufen
        const content = $('#email_template_editor').val();
        
        // AJAX-Anfrage senden
        $.post(ajax_object.ajax_url, {
            action: 'save_email_template', // Aktion für den AJAX-Hook
            content: content, // Editor-Inhalt
            save_template_nonce: ajax_object.save_template_nonce // Nonce für CSRF-Schutz
        })
        .done(function (response) {
            // Erfolgsmeldung anzeigen
            alert(response.success ? 'Template gespeichert!' : 'Fehler beim Speichern: ' + (response.data || 'Unbekannter Fehler'));
        })
        .fail(function () {
            // Fehler bei der Verbindung
            alert('Fehler bei der Verbindung zum Server.');
        });
    });
});

// Funktion um Email Vorschau anzuzeigen
document.getElementById('preview-email-template').addEventListener('click', function() {
    window.open('/confirmation-email-preview', '_blank');
});

// Funktion zum senden der Emailvorlage auf der Einstellungsseite
jQuery(document).ready(function ($) {
    $('#send-preview-email-template').on('click', function () {
        $.post(ajaxurl, {
            action: 'send_preview_email_template',
			send_template_nonce: ajax_object.send_template_nonce // Nonce für CSRF-Schutz
        }, function (response) {
            if (response.status === 'success') {
                alert('Test-Email gesendet!');
            } else {
                alert('Fehler beim Senden: ' + (response.message || 'Unbekannter Fehler.'));
            }
        });
    });
});