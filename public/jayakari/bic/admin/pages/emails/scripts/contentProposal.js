/**
 * Created by alienware on 1/4/2018.
 */

var contentProposal = {
    config: {
        batal: $('#batal'),
        kirim: false
    },
    init: function(settings){
        $.extend(contentProposal.config,settings);
        contentProposal.setup();
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
                if (contentProposal.config.kirim){
                    switch ($('#status').val()){
                        case "IN REVIEW":
                            contentProposal.redirectToPage(host+'/admin/adminproses/proposal/sudahreview');
                            break;
                        case "SELEKSI":
                            contentProposal.redirectToPage(host+'/admin/adminproses/proposal/seleksi');
                            break;
                        case "DISIMPAN":
                            contentProposal.redirectToPage(host+'/admin/adminproses/proposal/disimpan');
                            break;
                        case "DITERIMA":
                            contentProposal.redirectToPage(host+'/admin/adminproses/proposal/diterima');
                            break;
                        case "DITOLAK":
                            contentProposal.redirectToPage(host+'/admin/adminproses/proposal/ditolak');
                            break;
                    }
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
        contentProposal.init({});
    });
}

$('#kembali').on('click',function(){
    contentProposal.redirectToPage(host+'/admin/adminproses/message/inbox');
});

$('#pilihJuri').on('click',function(){
    contentProposal.config.kirim = true;
    if ($('#status').val() != "IN REVIEW"){
        toastr["error"]("Juri untuk proposal ini sudah dipilih. Anda akan dibawa kehalaman dimana proposal berada","Error");
    }else{
        contentProposal.redirectToPage(host+'/admin/adminproses/proposal/'+$('#idProposal').val()+'/juri');
    }
});