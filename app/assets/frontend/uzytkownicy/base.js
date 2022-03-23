import $ from "jquery";
window.$ = window.jQuery = $;

import lang_pl from '../website/polish.lang';
import routing from '../website/routings';
import Swal from "admin-lte/plugins/sweetalert2/sweetalert2";

$(function () {
    let tab = $("#uzytkownicy").DataTable({
        "language": lang_pl,
        "lengthMenu": [ 10, 25, 50, 75, 100 ],
        "ordering": false,
        "ajax": function() {
            $.ajax({
                url: routing.get('api_users'),
                dataType: 'json',
                success: function (json) {
                    tab.rows.add(json.data).draw();
                }
            });
        },
        "columns": [
            { "data": "imie" },
            { "data": "nazwisko" },
            { "data": "login" },
            { "data": "rola" },
            { "data": "dzielnica" },
            { "data": "status" }
        ],
        'columnDefs': [{
            "targets": [0,1,2,3,4,5], 
            "className": "text-center",
            // "width": "4%"
        },{
            'targets': 6,
            'searchable':false,
            'orderable':false,
            'className': 'text-center',
            'render': function (data, type, full, meta){
                return ' <button class="btn btn-sm" type="button" id="menu_'+full['id']+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>\
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu'+full['id']+'">\
                    <a href="'+ routing.get('uzytkownicy_view') + full['id'] +'" class="dropdown-item" type="button">Zobacz</a>\
                    <a href="'+ routing.get('uzytkownicy_edit') + full['id'] +'" class="dropdown-item" type="button">Edycja</a>\
                    <button class="dropdown-item disable-account" id="'+full['id']+'"  type="button">Wyłącz</button>\
                </div>';
            }
        }],
        "responsive": true, "lengthChange": true, "autoWidth": false
    });


$('body').on('click', '.disable-account', function() {
    Swal.fire({
        title: 'Uwaga!',
        text: "Czy na pewno chcesz wyłączyć konto użytkownika?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        reverseButtons: true,
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak, wyłącz użytkownika'
    }).then((result) => {
        let id = $(this).attr('id');
        if(result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/uzytkownicy/disable-account',
                data: {id: id},
                success: function(data) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Sukces!',
                            data.message,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location = '/uzytkownicy/index';
                            }
                        });
                    }
                }
            });
        }
    });
});
});