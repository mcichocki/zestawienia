// Style aplikacji
import '../styles/app.scss';

// jQuery
import $ from "jquery";
window.$ = window.jQuery = $;
import 'admin-lte/plugins/chart.js/Chart.js';

// Dodanie ikon
import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

// Bootstrap
import 'bootstrap';
import lang_pl from '../website/polish.lang';
import Snackbar from 'node-snackbar'

import 'admin-lte';
import 'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';
import 'admin-lte/plugins/jszip/jszip.min.js';
import 'admin-lte/plugins/pdfmake/pdfmake.min.js';
import 'admin-lte/plugins/pdfmake/vfs_fonts.js';
import 'admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js';
import 'admin-lte/plugins/datatables-buttons/js/buttons.print.min.js';
import 'admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js';
import 'admin-lte/plugins/datatables-select/js/dataTables.select';
import 'admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js';
import 'admin-lte/plugins/inputmask/jquery.inputmask.min.js';

import './web/confirm.js';
import './web/kikum.js';
import './web/message.js';
import './web/czynniki.js';
import './web/workflow.js';
import './web/estimate.js';

$(function () {
    $(window).on( "load", function(){
        let target = window.location.hash;
        if(target) {
            $('a[href="'+target+'"]').trigger('click');
        }
    });

    $(".testButton").click(function(){
        Snackbar.show({
            text: 'Example notification text.',
            pos: 'bottom-right'
        });
    });

    $("#formularz_save, .formularz_workflow, .builder_save, .import-file").click(function() {
        $('.loader').css('display', 'block');
    });

    $(".detail-window").click(function() {
        $('.modal').modal('toggle');
    });

    $('#uzytkownik_czyDomenowy').change(function(){
        $('#password_question').toggle();  
      });

    setTimeout(function () {
        $('.alert-success').fadeOut('slow');
    }, 10000);

    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    $(".accordion-toggle").click(function(){
        $(this).text(function(i, v){
            return v === 'Pokaż' ? 'Ukryj' : 'Pokaż'
        })
    });
});