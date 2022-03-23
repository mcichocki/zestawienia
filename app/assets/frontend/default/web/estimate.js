import $ from "jquery";
import Snackbar from 'node-snackbar';


// Przelicz dane
$(".przelicz_dane").click(function(){
    let row = $(this).attr('value');

    let rok_poprzedni = $("#builder_zestawienia_"+row+"_wartoscRokPoprzedni").val();
    let rok_zestawieniowy = $("#builder_zestawienia_"+row+"_wartoscRokZestawieniowy").val();

    let summary = rok_zestawieniowy - rok_poprzedni;
    let percentage = relDiff(parseFloat(rok_zestawieniowy), parseFloat(rok_poprzedni));

    $("#builder_zestawienia_"+row+"_wartoscRoznicaKwot").val(summary.toFixed(2));
    // $("#builder_zestawienia_"+row+"_wartoscRoznicaKwot").attr('value', summary.toFixed(2));
    $("#builder_zestawienia_"+row+"_wartoscProcentowa").val(percentage.toFixed(2));
    // $("#builder_zestawienia_"+row+"_wartoscProcentowa").attr('value', percentage.toFixed(2));
    Snackbar.show({
        pos: 'bottom-right',
        text: 'Przeliczono dane dla podgrupy.',
        showAction: false,
        duration: 3000
    });
});


// Wyczyść dane
$(".wyczysc_dane").click(function(){
    let row = $(this).attr('value');
    let value = parseFloat("0.00");
    value = value.toFixed(2);
    $("#builder_zestawienia_"+row+"_wartoscRokPoprzedni").val(value);
    $("#builder_zestawienia_"+row+"_wartoscRokZestawieniowy").val(value);
    $("#builder_zestawienia_"+row+"_wartoscRoznicaKwot").val(value);
    $("#builder_zestawienia_"+row+"_wartoscProcentowa").val(value);

    Snackbar.show({
        pos: 'bottom-right',
        text: 'Wartości zostały wyczyszczone w podgrupie.',
        showAction: false,
        duration: 3000
    });
});



// Przelicz wszystko
$(".przelicz-wszystko").click(function(){
    const podgrupy_count = $("#podgrupy").attr('value');
    let suma_rok_poprzedni = [];
    let suma_rok_biezacy   = [];

    for(let i = 0; i < podgrupy_count; i++) {
        let rok_poprzedni = parseFloat($("#builder_zestawienia_"+i+"_wartoscRokPoprzedni").val());
        let rok_biezacy   = parseFloat($("#builder_zestawienia_"+i+"_wartoscRokZestawieniowy").val());
        suma_rok_poprzedni.push(rok_poprzedni);
        suma_rok_biezacy.push(rok_biezacy);
    }

    $.ajax({
        url: "/zestawienie/math-calc-all",
        type: 'post',
        data: {
            rok_poprzedni:     suma_rok_poprzedni,
            rok_zestawieniowy: suma_rok_biezacy,
            count_podgrupy:    podgrupy_count
        },
        success: function (response) {
            $.each(response.data, function(index, value) {
                $("."+value.suma).val(value.wartosc);
                $("#builder_zestawienia_"+index+"_wartoscRoznicaKwot").val(value.wartosc);
                $("#builder_zestawienia_"+index+"_wartoscProcentowa").val(value.procent);
            });
            $("#builder_save").attr("disabled", false);
            Snackbar.show({
                pos: 'bottom-right',
                text: response.message,
                showAction: false,
                duration: 3000
            });
        }
    });
});

// Maska (ustawienia)
$('.valuemask').inputmask('decimal', {
    digits: 2,
    groupSeparator: " ",
    radixPoint: ",",
    autoGroup: true,
    allowPlus: false,
    allowMinus: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
    onBeforeMask: function (value, opts) {
        return value.replace(".", ",");
    },
    onUnMask: function(maskedValue, unmaskedValue) {
        var x = maskedValue.split(',');

        if (typeof(x[1]) == "undefined")
        {
            x[1] = 0;
        }
        return x[0].replace(/\s/g, '') + '.' + x[1];
    }
});

// Wzór do przeliczania
function relDiff(a, b) {
    return ((b - a) / a ) * 100;
}
