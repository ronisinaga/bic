/**
 * Created by alienware on 1/4/2018.
 */

var reset = {
    config: {
        valid: false,
        file: null
    },
    init: function(settings){
        $.extend(reset.config,settings);
        reset.setup();
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
                if (reset.config.valid){
                    //location.href = host+'/admin/usergroup';
                    reset.redirectToPage(host+'/admin/juri/reset');
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

        $("#selJuri").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },
    valid : function(){
        reset.config.valid = true;
        if ($('#password').val() == ''){
            reset.config.valid = false;
            toastr['error']("Password harus diisi.","Error");
        }
        if ($('#password').val() != $('#retype').val()){
            reset.config.valid = false;
            toastr['error']("Password dan Retype Password harus sama.","Error");
        }
        return reset.config.valid;
    },

    ubahPassword: function(json){
        if (reset.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/juri/reset',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    //alert(host+'/admin/users/ubahPassword');
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
        }
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        reset.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#ubah').on('click',function(){
    var json= '{"sender":"bic","id":'+$('#selJuri').val()+',"password":"'+$("#password").val()+'"}';
    reset.ubahPassword(json);
});

$('#selJuri').on('change',function(){
    if ($('#selJuri').val() != ''){
        $('#divPassword').css('display','block');
    }else{
        $('#divPassword').css('display','none');
    }
});