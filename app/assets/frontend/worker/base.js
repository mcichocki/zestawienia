import $ from "jquery";
import lang_pl from '../website/polish.lang';
import 'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';

$("#worker_jednostki").DataTable({
    "language": lang_pl,
    "order": [[ 0, "asc" ]],
    "columnDefs": [ {
        "targets": [5],
        "orderable": false
    } ]
});
