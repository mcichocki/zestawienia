import $ from "jquery";
import routing from "../website/routings";

$("#select_year").click(function(){
    let jednostka = $("#jednostka").val();

    console.log(jednostka);
    let year = $("#select_year option:selected").val();
});