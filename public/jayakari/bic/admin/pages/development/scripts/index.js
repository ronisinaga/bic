/**
 * Created by alienware on 1/4/2018.
 */

var $development = {
    config: {

    },
    init: function(settings){
        $.extend($development.config,settings);
        $development.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $development.redirectToPage(host+'/admin/development/create');
});