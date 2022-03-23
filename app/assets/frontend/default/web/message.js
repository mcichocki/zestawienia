import $ from "jquery";
import logoPath from '../../../images/anonymous.png';

$('.custom-file-input').on('change', function(event) {
    var inputFile = event.currentTarget;
    $(inputFile).parent()
        .find('.custom-file-label')
        .html(inputFile.files[0].name);
});

$(".message-item").click(function(){
    var target = window.location.hash;
    $('a[href="' + target + '"]').trigger('click');
});

$(".send-message").click(function(){
    let formularz = $(this).attr('id');
    let uzytkownik = $(this).attr('value');
    let login = $("#login").val();
    let tresc = $('textarea[name="message"]').val();


    $.ajax({
        url: "/messages/post",
        type: 'post',
        data: {
            tresc: tresc,
            uzytkownik:uzytkownik,
            formularz:formularz
        },
        success: function(res) {

            let content = "";
            $.each(res.data , function(index, value) {
                let klasa = "";
                let float1 = "";
                let float2 = "";
                if(login != value.login) {
                    klasa = "right"; float1 = "float-left"; float2 = "float-right";
                }
                else {
                    float1 = "float-right";
                }
                content += '\
                <div class="direct-chat-msg '+klasa+'">\
                    <div class="direct-chat-infos clearfix"> \
                        <span class="direct-chat-name '+float2+'">'+value.imie+' '+value.nazwisko+' ('+value.login+')</span>\
                        <span class="direct-chat-timestamp '+float1+'">'+value.data+'</span>\
                    </div>';
                    content += `<img class="direct-chat-img" src="${logoPath}" alt="message user image">`;
                    content += '<div class="direct-chat-text">'+value.tresc+'</div>\
                </div>';
            });
            $(".direct-chat-messages").html(content);
            $('textarea[name="message"]').val('');
        }
    });
});