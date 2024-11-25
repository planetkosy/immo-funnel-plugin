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
        const content = $('#email-template-editor').val();
        $.post(ajaxurl, {
            action: 'save_email_template',
            content: content,
        }, function (response) {
            alert(response.success ? 'Template gespeichert!' : 'Fehler beim Speichern');
        });
    });
});