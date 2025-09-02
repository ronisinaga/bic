/**
 * Created by alienware on 1/4/2018.
 */

var batch = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(batch.config,settings);
        batch.setup();
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
                if (batch.config.valid){
                    batch.redirectToPage(host+'/admin/batch');
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
        batch.config.valid = true;
        if ($('#batch').val() == ''){
            toastr['error']('Nama Batch harus diisi','Error');
            batch.config.valid = false;
        }
        if ($('#tahun').val() == ""){
            toastr['error']('Tahun Batch harus diisi','Error');
            batch.config.valid = false;
        }
        return batch.config.valid;
    },

    save: function(json){
        if (batch.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/batch/'+$('#id').val()+'/edit',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil update data kedalam database","Success");
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
        batch.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var arr = {
        "sender":"bic",
        "id":$("#id").val(),
        "batch":$("#batch").val(),
        "tahun":$("#tahun").val(),
        "keterangan":$("#keterangan").val()
    };
    var json= JSON.stringify(arr);
    batch.save(json);
});

$('#btnBatal').on('click',function(){
    batch.redirectToPage(host+'/admin/batch');
});