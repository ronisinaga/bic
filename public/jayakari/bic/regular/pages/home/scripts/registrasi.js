/**
 * Created by alienware on 12/24/2017.
 */
var registrasi = {
    config: {
        valid: false
    },
    init: function(settings){
        $.extend(registrasi.config,settings);
        registrasi.setup();
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
                if (registrasi.config.valid){
                    registrasi.redirectToPage(host+'/general/terimakasih');
                }
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

    validateEmail: function(email){
        if (email == ''){
            toastr['error']('Email tidak boleh kosong','Error');
            return false;
        }else{
            //cek apakah email sudah dalam format email
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var valid = re.test(email.toLowerCase());
            if (!valid){
                toastr['error']('Input tidak dalam format email. Pastikan input dalam format email','Error');
                return false;
            }else{
                return true;
            }
        }
    },

    valid: function(){
        if (!registrasi.validateEmail($('#email').val())){
            registrasi.config.valid = false;
            return false;
        }else if($('#password').val() == ''){
            toastr['error']('Password tidak boleh kosong','Error');
            registrasi.config.valid = false;
            return false;
        }else if($('#password').val() != $('#retype').val()){
            toastr['error']('Password dan retype password tidak sama. Pastikan password dan retype password sama','Error');
            registrasi.config.valid = false;
            return false;
        }else if($('#name').val() == ''){
            toastr['error']('Nama tidak boleh kosong','Error');
            registrasi.config.valid = false;
            return false;
        }else{
            registrasi.config.valid = true;
            return true;
        }
    },

    submit: function(json){
        if (registrasi.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/general/registrasi',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success') {
                        registrasi.config.valid = true;
                        toastr['success']("Registrasi inovator berhasil dilakukan.","Success");
                    }else if (response.status == 'exist'){
                        registrasi.config.valid = false;
                        toastr['error']("Email yang dimasukkan sudah ada dalam basisdata kami. Gunakan alamat email yang lain","Error");
                    }else{
                        registrasi.config.valid = false;
                        toastr['error']("Kesalahan tidak dikenali, hubungi administrator anda","Error");
                    }
                },
                error: function (response) {
                    //toastr['error']('Registrasi gagal dilakukan. Hubungi administrator anda',"Error");
                    registrasi.config.valid = false;
                    document.write(response.responseText);
                }
            });
        }
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        registrasi.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading"); },
    ajaxStop: function() { $body.removeClass("loading"); }
});

$('#registrasi').on('click',function(){
    var arr={
        "sender":"bic",
        "email":$('#email').val(),
        "password":$('#password').val(),
        "fullname":$('#name').val(),
        "jk":$('#selJK').val(),
        "hp":$('#hp').val(),
        "alamat":$('#alamat').val(),
        "alasan":$('#alasan').val()
    }
    var json = JSON.stringify(arr);
    registrasi.submit(json);
});

$('#utama').on('click',function(){
    registrasi.redirectToPage(host);
});

$('#batal').on('click',function(){
    registrasi.redirectToPage(host);
});