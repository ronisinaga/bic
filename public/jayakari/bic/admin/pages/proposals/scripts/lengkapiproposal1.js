/**
 * Created by alienware on 1/4/2018.
 */

var lengkapiproposal = {
    config: {
        review: $('#review')
    },
    init: function(settings){
        $.extend(lengkapiproposal.config,settings);
        lengkapiproposal.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        lengkapiproposal.init({});
    });
}

$('#update').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/proposals/listProposalsInovator');
});

$('#batal').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/proposals/listProposalsInovator');
});

$('#review').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/email/newemailInovator');
});