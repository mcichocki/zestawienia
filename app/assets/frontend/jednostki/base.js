import $ from "jquery";
window.$ = window.jQuery = $;

import lang_pl from '../website/polish.lang';
import routing from '../website/routings';
import Snackbar from 'node-snackbar';
import Swal from "admin-lte/plugins/sweetalert2/sweetalert2";

$(function () {
    let tab = $("#jednostki").DataTable({
        "language": lang_pl,
        "lengthMenu": [ 10, 25, 50, 75, 100 ],
        // "ordering": false,
        // "dom": "<'row'<'col-md-6'l><'col-md-6'f>>", 
        // "dom": "Blfrtip",
        "dom": "<'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
        buttons: [
            { extend: 'copy', 
            className: 'btn btn-sm btn-primary', 
            text: '<i class="fas fa-copy"></i> Kopiuj',
            titleAttr: 'Kopiuj'
            },
            { extend: 'print', 
            className: 'btn btn-sm btn-primary', 
            text: '<i class="fas fa-print"></i> Drukuj',
            titleAttr: 'Drukuj'
            },
            { extend: 'pdf', 
                className: 'btn btn-sm btn-primary', 
                text: '<i class="fas fa-file-pdf"></i> PDF',
                titleAttr: 'PDF'
            },
            { extend: 'csv', 
                className: 'btn btn-sm btn-primary', 
                text: '<i class="fas fa-file-csv"></i> CSV',
                titleAttr: 'CSV'
            },
            // 'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": function() {
            $.ajax({
                url: routing.get('api_jednostki'),
                dataType: 'json',
                success: function (json) {
                    tab.rows.add(json.data).draw();
                }
            });
        },
        'columnDefs': [{
            'targets': [3,4,5,6],
            'className': 'text-center'
        },{
            'targets': 0,
            'searchable':false,
            'orderable':false,
            'className': 'text-center',
            'render': function (data, type, full, meta){
                return '<input type="checkbox" name="id[]" value="'+full[0]+'">';
            }
        }, 
        {
            'targets': 7,
            'searchable':false,
            'orderable':false,
            'className': 'text-center',
            'render': function (data, type, full, meta){
                return ' <button class="btn btn-sm" type="button" id="menu_'+full[0]+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>\
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu'+full[0]+'">\
                    <a href="" class="dropdown-item" type="button">Zobacz</a>\
                    <a href="" class="dropdown-item" type="button">Edycja</a>\
                    <a href="" class="dropdown-item" type="button">Usuń</a>\
                </div>';
                // return '<button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-ellipsis-v"></i></button>';
            }
        }],
        'order': [1, 'asc'],
        "responsive": true, "lengthChange": true, "autoWidth": false,
    });

$("#remove_all_units").click(function(){
    Swal.fire({
        title: 'Uwaga!',
        text: "Czy na pewno chcesz usunąć wszystkie jednostki z bazy danych?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        reverseButtons: true,
        cancelButtonColor: '#d33',
        cancelButtonText: 'Anuluj',
        confirmButtonText: 'Tak, usuń jednostki'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: routing.get("jednostki_remove_all"),
                beforeSend: function(){
                    $('.loader').css('display', 'block');
                },
                success: function(data) {
                    if (result.isConfirmed) {
                        $('.loader').css('display', 'none');
                        Swal.fire(
                            'Usunięto!',
                            data.message,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                tab.clear().draw();
                            }
                        });
                    }
                }
            });
        }
    });
});

    
    $('#example-select-all').on('click', function(){
        // Check/uncheck all checkboxes in the table
        var rows = tab.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        $("#send").toggle();
    });

    $('#jednostki tbody').on('change', 'input[type="checkbox"]', function(){
        // If checkbox is not checked
        $("#send").show();
        if(!this.checked){
        var el = $('#example-select-all').get(0);
        $("#send").hide();
        // If "Select all" control is checked and has 'indeterminate' property
        if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
        }
        }
    });

    $('#frm-example').on('submit', function(e){
        var form = this;

        // Iterate over all checkboxes in the table
        table.$('input[type="checkbox"]').each(function(){
        // If checkbox doesn't exist in DOM
        if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
                // Create a hidden element 
                $(form).append(
                    $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', this.name)
                    .val(this.value)
                );
            }
        } 
        });

        // FOR TESTING ONLY
        
        // Output form data to a console
        $('#example-console').text($(form).serialize()); 
        console.log("Form submission", $(form).serialize()); 
        
        // Prevent actual form submission
        e.preventDefault();
    });

    $("#example1").DataTable({
        "language": lang_pl,
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": {
        buttons: [
            { extend: 'copy', className: 'btn btn-sm btn-primary' },
            { extend: 'csv', className: 'btn btn-sm btn-primary' },
            { extend: 'excel', className: 'btn btn-sm btn-primary' },
            { extend: 'pdf', className: 'btn btn-sm btn-primary' },
            { extend: 'print', className: 'btn btn-sm btn-primary' },
            // { extend: 'colvis', className: 'btn btn-sm btn-primary' },
        ]
    },
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});