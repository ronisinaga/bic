/**
 * Created by alienware on 1/4/2018.
 */

var development = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(development.config,settings);
        development.setup();
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
                if (development.config.valid){
                    development.redirectToPage(host+'/admin/development');
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

        $("#selParent").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },

    valid: function(){
        if ($('#development').val() == ''){
            toastr['error']('Nama ARN harus diisi','Error');
            development.config.valid = false;
            return false;
        }else{
            development.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (development.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/development/'+$('#id').val()+'/edit',
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
        development.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //development.redirectToPage(host+'/admin/development');
    var json= '{"sender":"bic","id":"'+$("#id").val()+'","development":"'+$("#development").val()+'","kode":"'+$("#kode").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    development.save(json);
});

$('#btnBatal').on('click',function(){
    development.redirectToPage(host+'/admin/development');
});