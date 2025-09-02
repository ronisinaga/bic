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

$('#btnBatalBelumNilai').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/listProposalsBelumNilai');
});

$('#batalBawahBelumNilai').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/listProposalsBelumNilai');
});

$('#btnBatalSudahNilai').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/listProposalsSudahNilai');
});

$('#batalBawahSudahNilai').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/proposals/listProposalsSudahNilai');
});