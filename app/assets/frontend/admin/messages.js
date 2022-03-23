import $ from "jquery";
import lang_pl from '../website/polish.lang';
import 'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';

$("#admin_mails").DataTable({
    "language": lang_pl,
    "order": [[ 4, "desc" ]],
    "columnDefs": [ {
        "targets": [5],
        "orderable": false
    } ]
});

$("#admin_chats").DataTable({
    "language": lang_pl,
    "order": [[ 4, "desc" ]],
    "columnDefs": [ {
        "targets": [5],
        "orderable": false
    } ]
});

