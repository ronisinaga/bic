/**
 * Created by alienware on 1/4/2018.
 */

var faq = {
    config: {
        valid:true
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
    },

    delete: function(json){
        $.ajax({
            method: 'POST',
            url: hapus,
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    toastr['success']("Sistem berhasil dihapus dari sistem","Success");
                }
            },
            error: function (response) {
                document.write(response.responseText);
                //toastr['error'](response.responseText,"Error");
            }
        });
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

$('#sample_1 tbody').on('click','#delete',function(){
    var tr = $(this).closest('tr');
    var td = tr.find('td');
    $.confirm({
        title: 'Informasi',
        content: 'Apakah anda yakin mau menghapus pertanyaan '+$(td[3]).text()+'?Jika yakin klik tombol Ya, jika tidak klik tombol Tidak',
        buttons: {
            confirm: {
                text: "Ya",
                action: function () {
                    var arr = {
                        'sender':'BIC',
                        'id':$(td[1]).text()
                    }
                    var json = JSON.stringify(arr);
                    faq.delete(json);
                }
            },
            cancel: {
                text: "Tidak",
                action: function () {
                }
            }
        }
    });
});

$('#new').on('click',function(){
    faq.redirectToPage(create);
});