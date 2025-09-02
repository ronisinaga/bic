/**
 * Created by alienware on 1/4/2018.
 */

var topik = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(topik.config,settings);
        topik.setup();
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
                if (topik.config.valid){
                    topik.redirectToPage(host+'/admin/topik');
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
        topik.config.valid = true;
        if ($('#selBatch').val() == '0'){
            toastr['error']('Batch harus dipilih','Error');
            topik.config.valid = false;
        }
        if ($('#topik').val() == ""){
            toastr['error']('Topik harus diisi','Error');
            topik.config.valid = false;
        }
        return topik.config.valid;
    },

    save: function(json){
        if (topik.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/topik/create',
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
        topik.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //topik.redirectToPage(host+'/admin/topik');
    var arr = {
        "sender":"bic",
        "id_batch":$("#selBatch").val(),
        "topik":$("#topik").val(),
        "keterangan":$("#keterangan").val()
    };
    var json= JSON.stringify(arr);
    topik.save(json);
});

$('#btnBatal').on('click',function(){
    topik.redirectToPage(host+'/admin/topik');
});