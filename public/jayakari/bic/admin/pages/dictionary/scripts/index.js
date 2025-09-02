/**
 * Created by alienware on 1/4/2018.
 */

var $dictionary = {
    config: {

    },
    init: function(settings){
        $.extend($dictionary.config,settings);
        $dictionary.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $dictionary.redirectToPage(host+'/admin/dictionary/create');
});