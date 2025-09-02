/**
 * Created by alienware on 1/4/2018.
 */

var aktivasi = {
    config: {
        valid: false
    },
    init: function(settings){
        $.extend(aktivasi.config,settings);
        aktivasi.setup();
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
                if (aktivasi.config.valid){
                    //location.href = host+'/admin/usergroup';
                    aktivasi.redirectToPage(host+'/admin/home');
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

        $("#selInovator").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },

    valid: function(){
        if ($('#selInovator').val() == "0"){
            toastr["error"]('Pilih Inovator yang akan diaktivasi','Error');
            aktivasi.config.valid = false;
            return false;
        }else{
            aktivasi.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (aktivasi.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/inovator/deaktivasi',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil deaktivasi inovator","Success");
                    }else if (response.status == 'exist'){
                        aktivasi.config.valid = false;
                        toastr['error']("Sistem tidak berhasil deaktivasi inovator","Error");
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
        aktivasi.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var json= '{"sender":"bic","id_inovator":"'+$("#selInovator").val()+'"}';
    aktivasi.save(json);
});

$('#btnBatal').on('click',function(){
    aktivasi.redirectToPage(host+'/admin/home');
});