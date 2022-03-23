import $ from "jquery";
import Swal from "admin-lte/plugins/sweetalert2/sweetalert2";

$(".modal-window").click(function(){
    const podgrupa = $(this).attr('id');
    const formularz = $(this).attr('value');
    const jednostka = $(this).attr('data-id');
    const czynnik = $(this).attr('data-value');

    $('.modal').modal('toggle');

    $.ajax({
        url: "/czynniki/get",
        type: 'post',
        data: {
            podgrupa: podgrupa,
            formularz: formularz,
            czynnik: czynnik
        },
        success: function(res) {
            let content = "";
            $.each(res.data , function(index, value) {
                content += "<span class='p-3 mb-2' style='background-color:#f0f0f0; display:block;'>"+value.tresc+"</span>";
            });
            $(".content").html(content);
        }
    });
    let arr = {
        'id': podgrupa,
        'value': formularz,
        'data-value':czynnik
    };

    $(".save-btn").attr(arr);
    $("#exampleModalCenterTitle").html(jednostka);
});

$(".save-btn").click(function(){
    const podgrupa = $(this).attr('id');
    const formularz = $(this).attr('value');
    const czynnik = $(this).attr('data-value');
    const uzytkownik = $("#uzytkownik").val();
    const tresc = $("#tresc").val();

    $.ajax({
        type: "POST",
        url: "/czynniki/post",
        data: {
            'podgrupa': podgrupa,
            'formularz': formularz,
            'czynnik': czynnik,
            'tresc': tresc,
            'uzytkownik': uzytkownik
        },
        success: function(res) {
            let content = "";
            $.each(res.data , function(index, value) {
                content += "<span class='p-3 mb-2' style='background-color:#f0f0f0; display:block;'>"+value.tresc+"</span>";
            });
            $(".content").html(content);
        }
        // success: function(res) {
        //     console.log("test");
        //     //$(".content").empty();
        //     console.log(res);
        //     let content = "";
        //     $.each(res.data , function(index, value) {
        //         content += "<span class='p-3 mb-2' style='background-color:#f0f0f0; display:block;'>"+value.tresc+"</span>";
        //     });
        //
        //     $(".content").html(content);
        // }
    });

    Swal.fire({
        title: 'Sukces!',
        text: "Czynnik został dodany do zestawienia",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
    $("#tresc").val('');
});






