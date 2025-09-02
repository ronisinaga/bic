/**
 * Created by alienware on 1/4/2018.
 */

var juri = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(juri.config,settings);
        juri.setup();
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
                if (juri.config.valid){
                    juri.redirectToPage(host+'/admin/juri/teknis/belumrespon');
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
        juri.config.valid = true;
        if (CKEDITOR.instances['isi'].getData() == ''){
            toastr['error']('Pendapat anda belum ada. Silahkan menuliskan pendapat anda atau klik tombol kembali','Error');
            juri.config.valid = false;
        }
        return juri.config.valid;
    },

    save: function(json){
        if (juri.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/juri/teknis/'+$('#id').val()+'/respon',
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
        juri.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //juri.redirectToPage(host+'/admin/juri');
    var arr={
        "sender":"bic",
        "id":$('#id').val(),
        "isi":CKEDITOR.instances['isi'].getData()
    }
    var json= JSON.stringify(arr);
    juri.save(json);
});

$('#btnBatal').on('click',function(){
    juri.redirectToPage(host+'/admin/juri/teknis/belumrespon');
});