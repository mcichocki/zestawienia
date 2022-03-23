import $ from "jquery";
import routing from "../website/routings";

$("#search").click(function(){
    let id = $("#dzielnica option:selected").val();

    if(id != 0) {
        $.ajax({
            type: 'POST',
            url: '/manager/search',
            data: {id: id},
            success: function(result) {
                $(".dzielnice").html("");
                let content = "" +
                    "<div class='row'>" +
                    "<div class='col-md-4 mb-2'>" +
                    "<div class='card card-outline'>" +
                    "<div class='card-header'><h5 class='m-0'><b>"+result.dzielnica+"</b></h5></div>" +
                    "<div class='card-body card-width'>" +
                    "<h6 class='card-title'>Lista jednostek:</h6>" +
                    "<ul class='card-text'>";
                $.each(result.data , function(index, value) {
                    content += "<li class='card-style'><a href='"+routing.get('zestawienia_archiwum')+0+'/'+value.id+"'>"+value.nazwa+"</a></li>";
                });
                content += "</ul></div><div class='card-footer'><a href='' class='btn btn-sm btn-primary'>Lista zestawień</a></div>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
                $(".dzielnice").html(content);
            }
        });
    }
    else {
        window.location = '/manager';
    }
});