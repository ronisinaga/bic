/**
 * Created by alienware on 1/4/2018.
 */

var $kategoridictionary = {
    config: {

    },
    init: function(settings){
        $.extend($kategoridictionary.config,settings);
        $kategoridictionary.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $kategoridictionary.redirectToPage(host+'/admin/kategoridictionary/create');
});