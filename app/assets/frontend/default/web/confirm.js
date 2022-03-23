import $ from "jquery";
import Swal from "admin-lte/plugins/sweetalert2/sweetalert2";
import Snackbar from 'node-snackbar';

$(".form-delete").click(function(){
    Swal.fire({
        title: 'Uwaga!',
        text: "Czy na pewno chcesz usunąć formularz z bazy danych?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        reverseButtons: true,
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak, usuń zestawienie'
    }).then((result) => {
        if(result.isConfirmed) {
            let id = $(this).attr('value');
            $.ajax({
                type: 'POST',
                url: '/zestawienie/delete/'+id,
                data: {id: id},
                success: function(data) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Usunięto!',
                            data.message,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location = '/zestawienia/todo';
                            }
                        });
                    }
                }
            });
        }
    });
});

$(".send-form").click(function(){
    Swal.fire({
        title: 'Potwierdzenie',
        text: "Czy na pewno chcesz wysłać formularz do akceptacji?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak, wyślij zestawienie'
    }).then((result) => {
        if(result.isConfirmed) {
            let id = $(this).attr('value');
            $.ajax({
                type: 'POST',
                // url: '/zestawienie/delete/'+id,
                data: {id: id},
                success: function(data) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Wysłano!',
                            data.message,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location = '/zestawienie/index';
                            }
                        });
                    }
                }
            });
        }
    });
});

$(".form-edit").click(function(){
    Swal.fire(
        'Sukces',
        'Formularz został poprawnie usunięty z bazy danych!',
        'success'
    )
});

$(".button_success").click(function(){
    Snackbar.show({
        pos: 'bottom-right',
        text: 'Zestawienie zostało utworzone.',
        showAction: false,
        duration: 3000
    });
});