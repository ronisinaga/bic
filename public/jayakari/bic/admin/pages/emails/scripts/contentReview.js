/**
 * Created by alienware on 1/4/2018.
 */

var contentReview = {
    config: {
        batal: $('#batal'),
        kirim: false
    },
    init: function(settings){
        $.extend(contentReview.config,settings);
        contentReview.setup();
    },
    setup: function(){
        /*toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "onHidden": function() {
                if (contentReview.config.kirim){
                    switch ($('#status').val()){
                        case "REVISI":
                            contentReview.redirectToPage(host+'/admin/reviewer/proposal/revisi');
                            break;
                        case "INREVIEW":
                            contentReview.redirectToPage(host+'/admin/reviewer/proposal/sudahreview');
                            break;
                        case "SELEKSI":
                            contentReview.redirectToPage(host+'/admin/reviewer/proposal/seleksi');
                            break;
                        case "DISIMPAN":
                            contentReview.redirectToPage(host+'/admin/reviewer/proposal/disimpan');
                            break;
                        case "DITERIMA":
                            contentReview.redirectToPage(host+'/admin/reviewer/proposal/diterima');
                            break;
                        case "DITOLAK":
                            contentReview.redirectToPage(host+'/admin/reviewer/proposal/ditolak');
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
        };*/
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        contentReview.init({});
    });
}

$('#kembali').on('click',function(){
    contentReview.redirectToPage(host+'/admin/reviewer/message/inbox');
});

$('#kembaliSent').on('click',function(){
    contentReview.redirectToPage(host+'/admin/reviewer/message/sent');
});

$('#review').on('click',function(){
    contentReview.config.kirim = true;
    if ($('#status').val() != "REVIEW"){
        toastr["error"]("Proposal sudah direview. Anda akan dibawa kehalaman dimana proposal berada","Error");
    }else{
        contentReview.redirectToPage(host+'/admin/reviewer/proposal/'+$('#idProposal').val()+'/review');
    }
});