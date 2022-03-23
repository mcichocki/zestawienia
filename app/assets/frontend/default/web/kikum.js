import $ from "jquery";
import Snackbar from 'node-snackbar';

$(".dane-z-kikum").click(function() {
    Snackbar.show({
        pos: 'bottom-right',
        text: 'Dane za rok poprzedni pobrane z Kikum!',
        showAction: false,
        duration: 3000
    });
});

$(".dane-z-systemu").click(function() {
    Snackbar.show({
        pos: 'bottom-right',
        text: 'Dane za rok poprzedni pobrane z systemu!',
        showAction: false,
        duration: 3000
    });
});