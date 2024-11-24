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

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.nav-tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();
            tabs.forEach(t => t.classList.remove('nav-tab-active'));
            contents.forEach(c => c.classList.remove('active'));

            this.classList.add('nav-tab-active');
            const target = document.querySelector(this.getAttribute('href'));
            target.classList.add('active');
        });
    });
});