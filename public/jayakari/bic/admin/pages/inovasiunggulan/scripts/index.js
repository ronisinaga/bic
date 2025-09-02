/**
 * Created by alienware on 1/4/2018.
 */

var $unggulan = {
    config: {

    },
    init: function(settings){
        $.extend($unggulan.config,settings);
        $unggulan.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $unggulan.redirectToPage(host+'/admin/inovasi/unggulan/create');
});