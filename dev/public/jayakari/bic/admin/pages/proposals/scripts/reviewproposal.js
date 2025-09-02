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

$('#btnSimpan').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/listProposalsReviewer');
});

$('#btnBatal').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/listProposalsReviewer');
});