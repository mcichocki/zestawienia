import $ from "jquery";
import Swal from "admin-lte/plugins/sweetalert2/sweetalert2";
import Snackbar from "node-snackbar";

$(".correct-window").click(function() {
    $("#wartosc_podgrupy").val('0.00');
    $("#wartosc_zestawienia").val('0.00');
    $('#podgrupa-selected option:contains("Wybierz podgrupę")').prop('selected',true);
    $('.modal').modal('toggle');
});

// Lista rozwijana podgrup
$("#podgrupa-selected").click(function() {
    $("#wartosc_podgrupy").val('');
    $("#wartosc_zestawienia").val('');

    let formularz = $("#formularz").val();
    let podgrupa = $("#podgrupa-selected option:selected").val();
    $.ajax({
        type: 'POST',
        url: '/zestawienie/korekta/get',
        data: {
            formularz: formularz,
            podgrupa: podgrupa
        },
        beforeSend: function() {
        },
        success: function(res) {
            $("#wartosc_podgrupy").val(res.data.podgrupa);
            $("#wartosc_zestawienia").val(res.data.wartosc);
            Snackbar.show({
                pos: 'bottom-right',
                text: res.message,
                showAction: false,
                duration: 3000
            });
        }
    });
});

// Zapisywanie zestawienia
$(".zapisz-korekte").click(function(){
    Swal.fire({
        title: 'Potwierdzenie',
        text: "Czy na pewno chcesz zapisać korektę?",
        icon: 'question',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak'
    }).then((result) => {
        let formularz = $("#formularz").val();
        let podgrupa = $("#podgrupa-selected option:selected").val();
        let wartosc_podgrupy = $("#wartosc_podgrupy").val();
        let wartosc_zestawienia = $("#wartosc_zestawienia").val();
        let nowa_wartosc =$("#nowa_wartosc").val();
        let komentarz =$("#komentarz").val();
        let nowa_suma =$("#nowa_suma").val();

        if(result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/zestawienie/korekta/post',
                data: {
                    formularz: formularz,
                    podgrupa: podgrupa,
                    wartosc_podgrupy: wartosc_podgrupy,
                    wartosc_zestawienia: wartosc_zestawienia,
                    nowa_wartosc: nowa_wartosc,
                    komentarz: komentarz,
                    nowa_suma: nowa_suma
                },
                beforeSend: function() {
                    // $('.loader').css('display', 'block');
                },
                success: function(data) {
                    // $('.loader').css('display', 'none');
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Wysłano!',
                            data.message,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "#custom-content-above-correct";
                                location.reload();
                            }
                        });
                    }
                }
            });
        }
    });
});

// Dynamiczne przeliczanie kwoty
$("#nowa_wartosc").keyup(function() {
    let val = $(this).val();
    val = parseFloat(val);
    let val1 = val.toFixed(2);
    $("#nowa_suma").val(val1);
});

// Wyczyść pola (button)
$(".clean-fields").click(function() {
    $("#wartosc_podgrupy").val('0.00');
    $("#wartosc_zestawienia").val('0.00');
    $("#nowa_wartosc").val('0.00');
    $("#komentarz").val('');
    $("#nowa_suma").val('0.00');
    // $("#podgrupa-selected option:selected");
    $('#podgrupa-selected option:contains("Wybierz podgrupę")').prop('selected',true);
});


// Usuwanie korekty
$(".usun-korekte").click(function(){
    Swal.fire({
        title: 'Potwierdzenie',
        text: "Czy na pewno chcesz usunąć korektę?",
        icon: 'question',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak'
    }).then((result) => {
        let korekta = $(this).attr("value");
        console.log(korekta);
        if(result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/zestawienie/korekta/delete',
                data: {
                    korekta: korekta,
                },
                success: function(data) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Usunięto!',
                            data.message,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "#custom-content-above-correct";
                                location.reload();
                            }
                        });
                    }
                }
            });
        }
    });
});