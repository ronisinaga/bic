/**
 * Created by alienware on 1/4/2018.
 */

var inreviewTitle = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(inreviewTitle.config,settings);
        inreviewTitle.setup();
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
                if (inreviewTitle.config.valid){
                    inreviewTitle.redirectToPage(host+'/general/inreviewTitle/utama/'+$('#judul').val());
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
        inreviewTitle.config.valid = true;
        if ($('#name').val() == ''){
            toastr['error']('Nama tidak boleh kosong','Error');
            inreviewTitle.config.valid = false;
        }if ($('#email').val() == ""){
            toastr['error']('Email tidak boleh kosong','Error');
            inreviewTitle.config.valid = false;
        }if ($('#comment').val() == ""){
            toastr['error']('Komentar tidak boleh kosong','Error');
            inreviewTitle.config.valid = false;
        }
        return inreviewTitle.config.valid;
    },

    saveComment: function(json){
        if (inreviewTitle.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/general/inreviewTitle/saveComment',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil menambahkan komentar kedalam database","Success");
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
        inreviewTitle.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnKirim').on('click',function(){
    //inreviewTitle.redirectToPage(host+'/admin/inreviewTitle');
    var arr = {
        "sender":"bic",
        "id":$("#id").val(),
        "name":$("#name").val(),
        "email":$("#email").val(),
        "comment":$("#comment").val()
    };
    var json= JSON.stringify(arr);
    inreviewTitle.saveComment(json);
});