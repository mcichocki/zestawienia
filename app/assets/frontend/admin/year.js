import $ from "jquery";
import Swal from "admin-lte/plugins/sweetalert2/sweetalert2";

$(".zapisz-rok").click(function(){
    let id = $('input[name=rok]:checked').val();
    Swal.fire({
        title: 'Potwierdzenie',
        text: "Czy na pewno chcesz ustawić rok?",
        icon: 'question',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/rok/update',
                data: {id: id},
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
                                window.location = '/rok/dashboard';
                            }
                        });
                    }
                }
            });
        }
    });
});

$(".wylacz-lata").click(function(){
    Swal.fire({
        title: 'Potwierdzenie',
        text: "Czy na pewno chcesz wyłączyć rok?",
        icon: 'question',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/rok/disable',
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
                                window.location = '/rok/dashboard';
                            }
                        });
                    }
                }
            });
        }
    });
});