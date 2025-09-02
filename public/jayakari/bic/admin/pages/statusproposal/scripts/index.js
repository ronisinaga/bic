/**
 * Created by alienware on 1/4/2018.
 */

var $statusproposal = {
    config: {

    },
    init: function(settings){
        $.extend($statusproposal.config,settings);
        $statusproposal.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $statusproposal.redirectToPage(host+'/admin/statusproposal/create');
});