/**
 * Created by alienware on 1/4/2018.
 */

var rsc = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(rsc.config,settings);
        rsc.setup();
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
                if (rsc.config.valid){
                    rsc.redirectToPage(host+'/admin/rsc');
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
        if ($('#rsc').val() == ''){
            toastr['error']('Nama Instansi harus diisi','Error');
            rsc.config.valid = false;
            return false;
        }else{
            rsc.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (rsc.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/rsc/create',
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
        rsc.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //rsc.redirectToPage(host+'/admin/rsc');
    var json= '{"sender":"bic","rsc":"'+$("#rsc").val()+'","kode":"'+$("#kode").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    rsc.save(json);
});

$('#btnBatal').on('click',function(){
    rsc.redirectToPage(host+'/admin/rsc');
});