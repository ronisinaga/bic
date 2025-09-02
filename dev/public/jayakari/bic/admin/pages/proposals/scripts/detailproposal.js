/**
 * Created by alienware on 1/4/2018.
 */

var reviewproposal = {
    config: {

    },
    init: function(settings){
        $.extend(reviewproposal.config,settings);
        reviewproposal.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#review').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/reviewProposal');
});

$('#kirimemailditolak').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/email/kirimEmailDitolak');
});

$('#kirimemailditerima').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/email/kirimEmailDiterima');
});

$('#btnBatal').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/listProposalsReviewer');
});

$('#batalBawah').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/listProposalsReviewer');
});