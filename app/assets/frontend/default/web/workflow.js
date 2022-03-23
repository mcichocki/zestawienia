import $ from "jquery";
import Swal from "admin-lte/plugins/sweetalert2/sweetalert2";

$(".send-to-accept").click(function(){
    Swal.fire({
        title: 'Potwierdzenie',
        text: "Czy na pewno chcesz przesłać formularz?",
        icon: 'question',
        reverseButtons: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak, wyślij zestawienie'
    }).then((result) => {
        if(result.isConfirmed) {
            let id    = $(this).attr('id');
            let value = $(this).attr('value');
            let path  = "/workflow/"+id+"/"+value;
            $.ajax({
                type: 'POST',
                url: path,
                data: {id: id},
                beforeSend: function() {
                    $('.loader').css('display', 'block');
                },
                success: function(data) {
                    $('.loader').css('display', 'none');
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Wysłano!',
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