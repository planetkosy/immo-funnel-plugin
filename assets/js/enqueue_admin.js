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