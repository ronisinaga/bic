/**
 * Created by alienware on 1/4/2018.
 */

var listproposal = {
    config: {

    },
    init: function(settings){
        $.extend(listproposal.config,settings);
        listproposal.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#editJudul').on('click',function(){
    listproposal.redirectToPage(host+'/admin/proposals/editJudulProposal');
});

$('#editJudul1').on('click',function(){
    listproposal.redirectToPage(host+'/admin/proposals/editJudulProposal1');
});

$('#lengkapi').on('click',function(){
    listproposal.redirectToPage(host+'/admin/proposals/lengkapiProposal');
});

$('#lengkapi1').on('click',function(){
    listproposal.redirectToPage(host+'/admin/proposals/lengkapiProposal1');
});

$('#ubahStatus').on('click',function(){
    listproposal.redirectToPage(host+'/admin/proposals/ubahStatusProposal');
});