/**
 * Created by alienware on 1/4/2018.
 */

var banner = {
    config: {
        valid:false,
        editor:null,
        data:null
    },
    init: function(settings){
        $.extend(banner.config,settings);
        banner.setup();
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
                if (banner.config.valid){
                    banner.redirectToPage(host+'/admin/banner');
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
        banner.config.editor = CKEDITOR.replace('isi');
        banner.config.data = new FormData();
    },
    validasi: function(){
        banner.config.valid = true;
        return banner.config.valid;
    },
    updateBanner: function(json){
        if (banner.validasi()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/banner/edit',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil update data kedalam database","Success");
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
        banner.init();
        $('.btn-outline').magnificPopup({type:'image'});
    });
}

$('#btnBatal').on('click',function(){
    banner.redirectToPage(host+'/admin/banner');
});

$('#btnSimpan').on('click',function(){
    var json = '{"sender":"bic","id":'+$('#id').val()+',"keterangan":"'+$('#keterangan').val()+'","is_active":'+$('#selAktif').val()+'}';
    banner.updateBanner(json);
});