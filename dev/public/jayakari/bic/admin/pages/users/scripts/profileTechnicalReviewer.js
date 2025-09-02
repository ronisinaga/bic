/**
 * Created by alienware on 1/4/2018.
 */

var profile = {
    config: {
        valid: false,
        file: null
    },
    init: function(settings){
        $.extend(profile.config,settings);
        profile.setup();
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
                if (profile.config.valid){
                    //location.href = host+'/admin/usergroup';
                    profile.redirectToPage(host+'/admin/home/technical');
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

    save: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/users/updateProfile',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    toastr['success']("Update data profile berhasil dilakukan","Success");
                }else{
                    toastr['error']("Update data profile gagal dilakukan. Hubungi administrator anda","Error");
                }
            },
            error: function (response) {
                //toastr['error'](response.responseText,"Error");
                document.write(response.responseText);
            }
        });
    },

    ubahPassword: function(json){
        if ($('#password').val() == $('#retype').val()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/users/ubahPassword',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Update password berhasil dilakukan","Success");
                    }else{
                        toastr['error']("Update password gagal dilakukan. Hubungi administrator anda","Error");
                    }
                },
                error: function (response) {
                    //toastr['error'](response.responseText,"Error");
                    document.write(response.responseText);
                }
            });
        }else{
            toastr["error"]("Password dan retype password tidak cocok. Ulangi kembali","Error");
        }
    },

    uploadFile : function(){
        var data = new FormData();
        data.append('id',$('#id').val());
        for(var i=0;i<profile.config.file.length;i++){
            var file = profile.config.file[i];
            if (file.size > 1048576){
                toastr["error"]('Ukuran file terlalu besar. Maksimum ukuran file adalah 1 MB','Error');
            }else{
                var type = '';
                allowable = true;
                switch (file.type){
                    case 'image/jpg':
                        type ='image';
                        break;
                    case 'image/png':
                        type ='image';
                        break;
                    case 'image/gif':
                        type ='image';
                        break;
                    case 'image/jpeg':
                        type ='image';
                        break;
                    case 'image/bmp':
                        type ='image';
                        break;
                    default:
                        allowable = false;
                        break;
                }
                if (allowable){
                    data.append('file',file);
                    data.append('tipe',type);
                    $.ajax({
                        method: 'POST',
                        url: host+'/admin/users/uploadFile',
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function (response){
                            if (response.status == "success"){
                                profile.config.valid = true;
                                toastr["success"]('Berhasil upload avatar technical','Success');
                                $('#popupUploadFile').modal('hide');
                            }else{
                                toastr["error"]('Gagal upload file yang berkaitan dengan proposal','Error');
                            }
                        },
                        error: function (response) {
                            alert(response.responseText);
                            //toastr['error'](response.responseText,"Error");
                        }
                    });
                }else{
                    toastr["error"]("Tipe File tidak dikenali","Error");
                }
            }
        }
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        profile.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#kirim').on('click',function(){
    var json= '{"sender":"bic","id":"'+$("#id").val()+'","fullname":"'+$("#fullname").val()+'","email":"'+$("#email").val()+'","jk":"'+$("#selJK").val()+'","hp":"'+$("#hp").val()+'","alamat":"'+$("#alamat").val()+'","alasan":"'+$("#alasan").val()+'"}';
    profile.save(json);
});

$('#ubah').on('click',function(){
    var json= '{"sender":"bic","password":"'+$("#password").val()+'"}';
    profile.ubahPassword(json);
});

$('input[type=file]').on('change', function(event){
    profile.config.file = event.target.files;
});

$('#upload').on('click',function(){
    $('form').on('submit',function(event){
        event.stopPropagation();
        event.preventDefault();
        profile.uploadFile();
    });
});