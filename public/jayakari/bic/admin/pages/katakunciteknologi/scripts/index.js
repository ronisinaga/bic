/**
 * Created by alienware on 1/4/2018.
 */

var $katakunci = {
    config: {

    },
    init: function(settings){
        $.extend($katakunci.config,settings);
        $katakunci.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $katakunci.redirectToPage(host+'/admin/katakunci/create');
});