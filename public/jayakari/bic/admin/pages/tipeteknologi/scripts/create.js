/**
 * Created by alienware on 1/4/2018.
 */

var tipeteknologi = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(tipeteknologi.config,settings);
        tipeteknologi.setup();
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
                if (tipeteknologi.config.valid){
                    tipeteknologi.redirectToPage(host+'/admin/tipeteknologi');
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

    valid: function(){
        if ($('#tipeteknologi').val() == ''){
            toastr['error']('Nama ARN harus diisi','Error');
            tipeteknologi.config.valid = false;
            return false;
        }else{
            tipeteknologi.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (tipeteknologi.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/tipeteknologi/create',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil menambahkan data kedalam database","Success");
                    }
                },
                error: function (response) {
                    document.write(response.responseText);
                    //toastr['error'](response.responseText,"Error");
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
        tipeteknologi.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //tipeteknologi.redirectToPage(host+'/admin/tipeteknologi');
    var json= '{"sender":"bic","tipeteknologi":"'+$("#tipeteknologi").val()+'","kode":"'+$("#kode").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    tipeteknologi.save(json);
});

$('#btnBatal').on('click',function(){
    tipeteknologi.redirectToPage(host+'/admin/tipeteknologi');
});