/**
 * Created by alienware on 1/4/2018.
 */

var $rsc = {
    config: {

    },
    init: function(settings){
        $.extend($rsc.config,settings);
        $rsc.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $rsc.redirectToPage(host+'/admin/rsc/create');
});