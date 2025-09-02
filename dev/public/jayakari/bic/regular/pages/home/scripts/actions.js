/**
 * Created by alienware on 12/24/2017.
 */
var login = {
    config: {
        valid: false
    },
    init: function(settings){
        $.extend(login.config,settings);
        login.setup();
    },
    setup: function() {

    },

    valid: function(){
        if ($('#username').val() == ''){
            toastr['error']('Username tidak boleh kosong','Error');
            login.config.valid = false;
            return false;
        }else if($('#password').val() == ''){
            toastr['error']('Password tidak boleh kosong','Error');
            login.config.valid = false;
            return false;
        }else{
            login.config.valid = true;
            return true;
        }
    },

    submit: function(json){
        if (login.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/users/validate',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        switch(response.category){
                            case 1:
                                login.redirectToPage(host+'/admin/home');
                                break;
                            case 2:
                                login.redirectToPage(host+'/admin/home/proposal');
                                break;
                            case 3:
                                login.redirectToPage(host+'/admin/home/reviewer');
                                break;
                            case 4:
                                login.redirectToPage(host+'/admin/home/inovator');
                                break;
                            case 5:
                                login.redirectToPage(host+'/admin/home/juri');
                                break;
                            case 6:
                                login.redirectToPage(host+'/admin/home/technical');
                                break;
                            case 7:
                                login.redirectToPage(host+'/admin/home/administrasi');
                                break;
                            case 9:
                                login.redirectToPage(host+'/admin/home/designer');
                                break;
                        }
                        toastr["success"]('Sukses');
                    }else if (response.status == 'failed'){
                        login.config.valid = false;
                        toastr['error']("Email atau password salah atau tidak cocok. Silahkan ulangi lagi atau hubungi administrator anda","Error");
                    }else if (response.status == 'inactive'){
                        login.config.valid = false;
                        toastr['error']("Account anda sudah tidak aktif. Silahkan ulangi lagi atau hubungi Pihak BIC","Error");
                    }else{
                        login.config.valid = false;
                        toastr['error']("Kesalahan tidak dikenali, hubungi administrator anda","Error");
                    }
                },
                error: function (response) {
                    //toastr['error'](response.responseText,"Error");
                    alert(response.responseText);
                    document.write(response.responseText);
                }
            });
        }
    },
    sendEmail: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/general/sendEmail',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    //send email
                    toastr["success"]('Password berhasil dikirim ke email anda. Silahkan cek email anda','Success');
                }else{
                    toastr["error"]('Alamat email anda belum terdaftar dalam database kami. Silahkan hubungi pihak BIC untuk berkoordinasi','Error');
                }
                $('#popupForgetPassword').modal('hide');
                $('#popupEmail').val('');
            },
            error: function (response) {
                alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                //document.write(response.responseText);
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        login.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#login').on('click',function(){
    if (login.valid()){
        var json = '{"sender":"bic","email":"'+$('#username').val()+'","password":"'+$('#password').val()+'"}';
        login.submit(json);
    }
});

$('#registrasi').on('click',function(){
    login.redirectToPage(host+'/general/registrasi');
});

$('#utama').on('click',function(){
    login.redirectToPage('http://bic.web.id');
});

$('#manual').on('click',function(){
    login.redirectToPage(host+'/general/manual');
});

$('#diagram').on('click',function(){
    login.redirectToPage(host+'/general/diagram');
});

$('#forget').on('click',function(){
    $('#popupForgetPassword').modal();
});

$('#send').on('click',function(){
    var json='{"sender":"bic","email":"'+$('#popupEmail').val()+'"}'
    login.sendEmail(json);
});