/**
 * Created by alienware on 1/4/2018.
 */

var askReview = {
    config: {
        batal: $('#batal'),
        kirim: false
    },
    init: function(settings){
        $.extend(askReview.config,settings);
        askReview.setup();
    },
    setup: function(){

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "onHidden": function() {
                if (askReview.config.kirim){
                    askReview.redirectToPage(host+'/admin/inovator/proposal');
                }
                //
            },
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    },

    redirectToPage : function(page){
        window.location = page;
    },
    sendEmail: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/message/saveMessage',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    askReview.config.kirim = true;
                    toastr["success"]('Message berhasil dikirim ke reviewer','Success');
                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    askReview.config.kirim = false;
                    toastr["error"]('Gagal mengirimkan pesan ke reviewer','Error');
                }
            },
            error: function (response) {
                askReview.config.kirim = false;
                //alert(response.responseText);
                //toastr["error"]('Gagal mengirimkan pesan ke reviewer. Hubungi administrator anda','Error');
                //toastr['error'](response.responseText,"Error");
                //$('#loadingDiv').removeClass('show');
                //$('#loadingDiv').addClass('hide');
                document.write(response.responseText);
            }
        });
    },
    replaceAll : function(search,replacement,string){
        return string.replace(new RegExp(search, 'g'), replacement);
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        askReview.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#kirim').on('click',function(){
    var isi = CKEDITOR.instances['isi'].getData();
    //isi = isi.replace('\n','');
    isi = askReview.replaceAll('\n','',isi);
    var arr = {
        "sender":"bic",
        "id_proposal":$('#id').val(),
        "judul":$('#judul').val(),
        "isi":isi
    };
    var json = JSON.stringify(arr);
    askReview.sendEmail(json);
});

$('#batal').on('click',function(){
    askReview.redirectToPage(host+'/admin/inovator/proposal');
});