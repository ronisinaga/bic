/**
 * Created by alienware on 1/4/2018.
 */

var kategoridictionary = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(kategoridictionary.config,settings);
        kategoridictionary.setup();
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
                if (kategoridictionary.config.valid){
                    kategoridictionary.redirectToPage(host+'/admin/kategoridictionary');
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

        $("#selTipe").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },

    valid: function(){
        kategoridictionary.config.valid = true;
        if ($('#kategoridictionary').val() == ''){
            toastr['error']('Nama Kategori Dictionary harus diisi','Error');
            kategoridictionary.config.valid = false;
        }
        if ($('#kode').val() == ''){
            toastr['error']('Kode Kategori Dictionary harus diisi','Error');
            kategoridictionary.config.valid = false;
        }
        return kategoridictionary.config.valid;
    },

    save: function(json){
        if (kategoridictionary.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/kategoridictionary/create',
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
        kategoridictionary.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //kategoridictionary.redirectToPage(host+'/admin/kategoridictionary');
    var json= '{"sender":"bic","tipe":"'+$('#selTipe').val()+'","kode":"'+$('#kode').val()+'","kategoridictionary":"'+$("#kategoridictionary").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    kategoridictionary.save(json);
});

$('#btnBatal').on('click',function(){
    kategoridictionary.redirectToPage(host+'/admin/kategoridictionary');
});