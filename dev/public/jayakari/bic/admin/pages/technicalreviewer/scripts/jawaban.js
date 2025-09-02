/**
 * Created by alienware on 1/4/2018.
 */

var technicalreviewer = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(technicalreviewer.config,settings);
        technicalreviewer.setup();
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
                if (technicalreviewer.config.valid){
                    technicalreviewer.redirectToPage(host+'/admin/technical/belumrespon');
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
        if (CKEDITOR.instances['jawaban'].getData() == ''){
            toastr['error']('Jawaban harus diisi','Error');
            technicalreviewer.config.valid = false;
            return false;
        }else{
            technicalreviewer.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (technicalreviewer.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/technical/jawaban',
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
        technicalreviewer.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //technicalreviewer.redirectToPage(host+'/admin/technicalreviewer');
    var arr = {
        "sender":"bic",
        "id_proposal":$('#id').val(),
        "jawaban":CKEDITOR.instances['jawaban'].getData()
    }
    var json= JSON.stringify(arr);
    technicalreviewer.save(json);
});

$('#btnBatal').on('click',function(){
    technicalreviewer.redirectToPage(host+'/admin/technical/belumrespon');
});