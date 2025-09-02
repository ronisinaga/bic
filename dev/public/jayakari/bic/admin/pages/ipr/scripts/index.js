/**
 * Created by alienware on 1/4/2018.
 */

var $ipr = {
    config: {

    },
    init: function(settings){
        $.extend($ipr.config,settings);
        $ipr.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $ipr.redirectToPage(host+'/admin/ipr/create');
});