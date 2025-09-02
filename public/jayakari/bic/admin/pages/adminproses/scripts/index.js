/**
 * Created by alienware on 1/4/2018.
 */

var $arn = {
    config: {

    },
    init: function(settings){
        $.extend($arn.config,settings);
        $arn.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $arn.redirectToPage(host+'/admin/arn/create');
});