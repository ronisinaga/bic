/**
 * Created by alienware on 1/4/2018.
 */

var statusproposal = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(statusproposal.config,settings);
        statusproposal.setup();
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
                if (statusproposal.config.valid){
                    statusproposal.redirectToPage(host+'/admin/statusproposal');
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
        if ($('#statusproposal').val() == ''){
            toastr['error']('Status Proposal harus diisi','Error');
            statusproposal.config.valid = false;
            return false;
        }else{
            statusproposal.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (statusproposal.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/statusproposal/create',
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
        statusproposal.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //statusproposal.redirectToPage(host+'/admin/statusproposal');
    var json= '{"sender":"bic","statusproposal":"'+$("#statusproposal").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    statusproposal.save(json);
});

$('#btnBatal').on('click',function(){
    statusproposal.redirectToPage(host+'/admin/statusproposal');
});