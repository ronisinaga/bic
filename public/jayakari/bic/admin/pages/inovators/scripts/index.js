/**
 * Created by alienware on 1/4/2018.
 */

var video = {
    config: {

    },
    init: function(settings){
        $.extend(video.config,settings);
        video.setup();
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
                video.redirectToPage(host+'/admin/inovator/video');
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

    hapus: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/video/delete',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status === 'success'){
                    toastr['success']("Sistem berhasil menghapus data dari database","Success");
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
        video.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#new').on('click',function(){
    video.redirectToPage(host+'/admin/inovator/video/add');
});

$('#sample_1').on('click','#delete',function(){
    var tr = $(this).closest('tr');
    var td = $(tr).find('td');
    var arr = {
        'sender':'BIC',
        'id':$(td[0]).text()
    };
    var json = JSON.stringify(arr);
    $.confirm({
        title: 'Konfirmasi!',
        content: 'Apakah anda yakin ingin menghapus data ini?',
        buttons: {
            confirm: {
                text: "Ya",
                action: function () {
                    video.hapus(json);
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