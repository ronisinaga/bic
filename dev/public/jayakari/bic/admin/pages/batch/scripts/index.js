/**
 * Created by alienware on 1/4/2018.
 */

var batch = {
    config: {

    },
    init: function(settings){
        $.extend(batch.config,settings);
        batch.setup();
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
                if (batch.config.valid){
                    batch.redirectToPage(host+'/admin/batch');
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

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        batch.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#new').on('click',function(){
    if ($('#total_listed').val() == '0'){
        batch.redirectToPage(host+'/admin/batch/create');
    }else{
        toastr['error']("Batch baru tidak dapat dibuat karena anda belum merubah seluruh proposal dengan status listed(disimpan) menjadi revisi","Error");
    }
});