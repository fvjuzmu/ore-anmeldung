var options = {
    onFail: function() {
        alert( unescape('Sie haben ' + $myform.getInvalid().length + ' Pflichtfelder nicht ausgef%FCllt.' ));
    },
    onSuccess: function() {
        // Form validates
    },

    inputs: {
        'wochen[]': {
            filters: 'required min',
            data: { min: 1 },
            errors: { min: 'Bitte <strong>mindestens</strong> eine Woche ausw&auml;hlen' }
        },

        'ezb-vorname': {
            filters: 'required',
            errors: { required: 'Tragen Sie hier Ihren Vornamen ein' }
        },
        'ezb-name': {
            filters: 'required',
            errors: { required: 'Tragen Sie hier Ihren Familiennamen ein' }
        },
        'ezb-strasse': {
            filters: 'required',
            errors: { required: 'Tragen Sie hier Ihre Adresse eintragen' }
        },
        'ezb-plz': {
            filters: 'required number',
            data: { min: 5 },
            errors: { required: 'Tragen Sie hier die PLZ Ihres Wohnorts ein' }
        },
        'ezb-ort': {
            filters: 'required',
            errors: { required: 'Tragen Sie hier Ihren Wohnort ein' }
        },
        'ezb-tel': {
            filters: 'required number',
            errors: {
                required: 'Tragen Sie hier die Telefonnummer ein unter der wir Sie erreichen k&ouml;nnen (bitte nur Ziffern)',
                number: 'Bitte hier nur Ziffern eingeben' }
        },
        'ezb-tel-mobil': {
            filters: 'number',
            errors: { number: 'Bitte hier nur Ziffern eingeben' }
        },
        'ezb-tel-arbeit': {
            filters: 'number',
            errors: { number: 'Bitte hier nur Ziffern eingeben' }
        },
        'ezb-mail': {
            filters: 'required email',
            errors: {
                required: 'Tragen Sie hier eine g&uuml;ltige E-Mail Adresse ein',
                email: 'Tragen Sie hier eine g&uuml;ltige E-Mail Adresse ein' }
        },

        'kind-eins-vorname': {
            filters: 'required',
            errors: { required: 'Hier den Vornamen des Kindes eintragen' }
        },
        'kind-eins-name': {
            filters: 'required',
            errors: { required: 'Hier den Nachnamen des Kindes eintragen' }
        },
        'kind-eins-geburt': {
            filters: 'required date',
            data: { date: 'dd.mm.yyyy' },
            errors: {
                required: 'Hier das Geburtsdatum des Kindes eintragen im Format tt.mm.jjjj, <strong>z.B.: 16.04.1997</strong>',
                date: 'Bitte ein g&uuml;ltiges Datum eingeben, <strong>z.B.: 16.04.1997</strong>' }
        },

        'kind-zwei-vorname': {
            filters: 'required',
            errors: { required: 'Hier den Vornamen des Kindes eintragen' }
        },
        'kind-zwei-name': {
            filters: 'required',
            errors: { required: 'Hier den Nachnamen des Kindes eintragen' }
        },
        'kind-zwei-geburt': {
            filters: 'required date',
            data: { date: 'dd.mm.yyyy' },
            errors: {
                required: 'Hier das Geburtsdatum des Kindes eintragen',
                date: 'Bitte ein g&uuml;ltiges Datum eingeben, <strong>z.B.: 16.04.1997</strong>' }
        },

        'kind-drei-vorname': {
            filters: 'required',
            errors: { required: 'Hier den Vornamen des Kindes eintragen' }
        },
        'kind-drei-name': {
            filters: 'required',
            errors: { required: 'Hier den Nachnamen des Kindes eintragen' }
        },
        'kind-drei-geburt': {
            filters: 'required date',
            data: { date: 'dd.mm.yyyy' },
            errors: {
                required: 'Hier das Geburtsdatum des Kindes eintragen',
                date: 'Bitte ein g&uuml;ltiges Datum eingeben, <strong>z.B.: 16.04.1997</strong>' }
        },

        'abhol': {
            filters: 'required min',
            data: { min: 1 },
            errors: {
                required: 'Bitte eine Auswahl treffen',
                min: 'Bitte eine Auswahl treffen' }
        },
        'abholer-eins': {
            filters: 'max',
            data: { max: 255 },
            errors: {  max: 'Bitte nicht mehr als 255 Zeichen eingeben' }
        },
        'abholer-zwei': {
            filters: 'max',
            data: { max: 255 },
            errors: {  max: 'Bitte nicht mehr als 255 Zeichen eingeben' }
        },
        'abholer-drei': {
            filters: 'max',
            data: { max: 255 },
            errors: {  max: 'Bitte nicht mehr als 255 Zeichen eingeben' }
        },
        'abholer-vier': {
            filters: 'max',
            data: { max: 255 },
            errors: {  max: 'Bitte nicht mehr als 255 Zeichen eingeben' }
        },
        'abholer-fuenf': {
            filters: 'max',
            data: { max: 255 },
            errors: {  max: 'Bitte nicht mehr als 255 Zeichen eingeben' }
        }
    }
};

var $myform = $('#my-form').idealforms(options).data('idealforms');
$myform.focusFirstInvalid()

function getSelectedTabIndex() {
    var index = $(".ideal-tabs-tab-active").index();
    return index;
}

$('#button-weiter').click(function (){
    var numInvalidinTab = $myform.getInvalidInTab(getSelectedTabIndex());
    /*var numInvalidinTab = $myform.getInvalid();*/
    if(numInvalidinTab.length == 0)
    {
        $myform.nextTab();
    }
    else
    {
        alert(unescape("Bitte alle Pflichtfelder ausf%FCllen."));
        $myform.focusFirstInvalid()
    }

    if($('.hinweis').css('display') == 'block')
    {
        $('#button-senden').show();
    }
    else
    {
        $('#button-senden').hide();
    }
});