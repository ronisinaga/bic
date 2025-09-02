/**
 * Created by alienware on 1/4/2018.
 */

var instansi = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(instansi.config,settings);
        instansi.setup();
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
                if (instansi.config.valid){
                    instansi.redirectToPage(host+'/admin/instansi');
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
        if ($('#instansi').val() == ''){
            toastr['error']('Nama ARN harus diisi','Error');
            instansi.config.valid = false;
            return false;
        }else{
            instansi.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (instansi.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/instansi/'+$('#id').val()+'/edit',
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
                    //document.write(response.responseText);
                    toastr['error'](response.responseText,"Error");
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
        instansi.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //instansi.redirectToPage(host+'/admin/instansi');
    var json= '{"sender":"bic_new","id":"'+$("#id").val()+'","instansi":"'+$("#instansi").val()+'","kode":"'+$("#kode").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    instansi.save(json);
});

$('#btnBatal').on('click',function(){
    instansi.redirectToPage(host+'/admin/instansi');
});