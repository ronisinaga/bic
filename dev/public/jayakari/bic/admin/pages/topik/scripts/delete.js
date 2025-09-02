/**
 * Created by alienware on 1/4/2018.
 */

var topik = {
    config: {

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
                //location.href = host+'/admin/topik';
                topik.redirectToPage(host+'/admin/topik');
            },
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    },

    save: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/topik/'+$('#id').val()+'/delete',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                //$('#loadingDiv').removeClass('hide');
                //$('#loadingDiv').addClass('show');
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                //$('#loadingDiv').removeClass('show');
                //$('#loadingDiv').addClass('hide');
                if (response.status == 'success'){
                    //alert('berhasil menambahkan data kedalam database');
                    toastr['success']("Sistem berhasil hapus data topik "+$('#name').val(),"Success");
                }
            },
            error: function (response) {
                //alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                document.write(response.responseText);
            }
        });
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
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnHapus').on('click',function(){
    //topik.redirectToPage(host+'/admin/topik');
    var json= '{"sender":"bic","id":"'+$('#id').val()+'","topik":"'+$("#name").val()+'"}';
    topik.save(json);
});

$('#btnBatal').on('click',function(){
    topik.redirectToPage(host+'/admin/topik');
});