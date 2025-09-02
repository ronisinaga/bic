/**
 * Created by alienware on 1/4/2018.
 */

var unggulan = {
    config: {
        valid:false,
        editor: null
    },
    init: function(settings){
        $.extend(unggulan.config,settings);
        unggulan.setup();
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
                if (unggulan.config.valid){
                    unggulan.redirectToPage(host+'/admin/inovasi/unggulan');
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
        unggulan.config.editor = CKEDITOR.replace('keterangan');
        $("#selAktif").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },

    valid: function(){
        unggulan.config.valid = true;
        if ($('#tema').val() == ''){
            toastr['error']('Tema harus diisi','Error');
            unggulan.config.valid = false;
        }if (unggulan.config.editor.getData() == ''){
            toastr['error']('Kata Pengantar/Penjelasan tema harus diisi','Error');
            unggulan.config.valid = false;
        }
        return unggulan.config.valid;
    },

    save: function(json){
        if (unggulan.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/inovasi/unggulan/edit',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil update data inovasi unggulan","Success");
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
        unggulan.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //unggulan.redirectToPage(host+'/admin/unggulan');
    var arr={
        "sender":"bic",
        "id":$('#id').val(),
        "tema":$("#tema").val(),
        "is_active":$('#selAktif').val(),
        "keterangan":unggulan.config.editor.getData()
    }
    var json = JSON.stringify(arr);
    unggulan.save(json);
});

$('#btnBatal').on('click',function(){
    unggulan.redirectToPage(host+'/admin/unggulan');
});