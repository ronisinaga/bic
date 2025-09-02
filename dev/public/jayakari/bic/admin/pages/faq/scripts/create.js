/**
 * Created by alienware on 1/4/2018.
 */

var faq = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(faq.config,settings);
        faq.setup();
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
                if (faq.config.valid){
                    faq.redirectToPage(back);
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

        $("#selFAQType").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },

    valid: function(){
        result = true;
        if ($('#question').val() == ''){
            toastr['error']('Pertanyaan harus diisi','Error');
            faq.config.valid = false;
            result = false;
        }else{
            faq.config.valid = true;
        }
        if ($('#selFAQType').val() == '0'){
            toastr['error']('Kategori FAQ harus dipilih','Error');
            faq.config.valid = false;
            result = false;
        }else{
            faq.config.valid = true;
        }
        return result;
    },

    save: function(json){
        if (faq.valid()){
            $.ajax({
                method: 'POST',
                url: save,
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
        faq.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //faq.redirectToPage(host+'/admin/arn');
    var arr = {
        "sender":"bic",
        "faq_type":$('#selFAQType').val(),
        "question":$('#question').val(),
        "answer":CKEDITOR.instances['answer'].getData()
    };
    var json = JSON.stringify(arr);
    faq.save(json);
});

$('#btnBatal').on('click',function(){
    faq.redirectToPage(back);
});