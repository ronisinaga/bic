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
                    registrasi.redirectToPage(host+'/general/registrasi/seminar/terimakasih');
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

        $("#selJK").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },

    validateEmail: function(email){
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var valid = re.test(email.toLowerCase());
        if (!valid){
            return false;
        }else{
            return true;
        }
    },

    submit: function(json){
        $.ajax({
            method: 'POST',
            url: save,
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
                    toastr['success']("Registrasi peserta berhasil dilakukan.","Success");
                }else{
                    registrasi.config.valid = false;
                    toastr['error']("Registrasi peserta gagal dilakukan","Error");
                }
            },
            error: function (response) {
                //toastr['error']('Registrasi gagal dilakukan. Hubungi administrator anda',"Error");
                registrasi.config.valid = false;
                document.write(response.responseText);
            }
        });
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
    hadir = '';
    if ($('#seminar').prop('checked')){
        hadir = 'Seminar';
    }
    if ($('#workshop').prop('checked')){
        hadir = 'Workshop';
    }
    if ($('#both').prop('checked')){
        hadir = 'Seminar & Workshop';
    }
    var error = '<p>Mohon melengkapi data berikut:</p>';
    error += '<ul>';
    complete = true;
    if (hadir == ''){
        complete = false;
        error += '<li>Pilihan kehadiran pada Seminar, Workshop ada keduanya belum dipilih</li>';
    }
    if ($('#name').val() == ''){
        complete = false;
        error += '<li>Nama peserta tidak boleh kosong</li>';
    }
    if ($('#selJK').val() == ''){
        complete = false;
        error += '<li>Jenis kelamin belum dipilih</li>';
    }
    if ($('#jabatan').val() == ''){
        complete = false;
        error += '<li>Jabatan tidak boleh kosong</li>';
    }
    if ($('#perusahaan').val() == ''){
        complete = false;
        error += '<li>Nama perusahaan tidak boleh kosong</li>';
    }
    if ($('#alamat').val() == ''){
        complete = false;
        error += '<li>Alamat perusahaan tidak boleh kosong</li>';
    }
    if ($('#telp').val() == ''){
        complete = false;
        error += '<li>Nomor telepon/HP tidak boleh kosong</li>';
    }
    if ($('#email').val() == ''){
        complete = false;
        error += '<li>Email tidak boleh kosong</li>';
    }else{
        if (!registrasi.validateEmail($('#email').val().trim())){
            complete = false;
            error += '<li>Input email tidak dalam format email yang benar. Pastikan input dalam format email</li>';
        }
    }
    error += '</ul>';
    if (!complete){
        $('#error').html(error);
        $('#error').css('display','block');
        $('#errorBawah').html(error);
        $('#errorBawah').css('display','block');
    }else{
        $('#error').css('display','none');
        $('#errorBawah').css('display','none');
        var arr={
            "sender":"bic",
            "hadir":hadir,
            "jabatan":$('#jabatan').val(),
            "fullname":$('#name').val(),
            "jk":$('#selJK').val(),
            "perusahaan":$('#perusahaan').val(),
            "telp":$('#telp').val(),
            "alamat":$('#alamat').val(),
            "email":$('#email').val().trim()
        }
        var json = JSON.stringify(arr);
        registrasi.submit(json);
    }
});

$('#utama').on('click',function(){
    registrasi.redirectToPage(host);
});

$('#batal').on('click',function(){
    registrasi.redirectToPage(host);
});

$('#seminar').on('click',function(){
   $(this).prop('checked',true);
   $('#workshop').prop('checked',false);
   $('#both').prop('checked',false);
});

$('#workshop').on('click',function(){
    $(this).prop('checked',true);
    $('#seminar').prop('checked',false);
    $('#both').prop('checked',false);
});

$('#both').on('click',function(){
    $(this).prop('checked',true);
    $('#workshop').prop('checked',false);
    $('#seminar').prop('checked',false);
});