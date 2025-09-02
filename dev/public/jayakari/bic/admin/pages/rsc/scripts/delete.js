/**
 * Created by alienware on 1/4/2018.
 */

var rsc = {
    config: {

    },
    init: function(settings){
        $.extend(rsc.config,settings);
        rsc.setup();
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
                //location.href = host+'/admin/rsc';
                rsc.redirectToPage(host+'/admin/rsc');
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
            url: host+'/admin/rsc/'+$('#id').val()+'/delete',
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
                    toastr['success']("Sistem berhasil hapus data kategori menu "+$('#name').val(),"Success");
                }
            },
            error: function (response) {
                //alert(response.responseText);
                toastr['error'](response.responseText,"Error");
                //$('#loadingDiv').removeClass('show');
                //$('#loadingDiv').addClass('hide');
                //document.write(response.responseText);
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        rsc.init();
    });
    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnHapus').on('click',function(){
    //rsc.redirectToPage(host+'/admin/rsc');
    var json= '{"sender":"bic","id":"'+$('#id').val()+'","rsc":"'+$("#name").val()+'"}';
    rsc.save(json);
});

$('#btnBatal').on('click',function(){
    rsc.redirectToPage(host+'/admin/rsc');
});