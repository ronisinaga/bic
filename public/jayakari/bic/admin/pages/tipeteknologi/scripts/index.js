/**
 * Created by alienware on 1/4/2018.
 */

var $tipeteknologi = {
    config: {

    },
    init: function(settings){
        $.extend($tipeteknologi.config,settings);
        $tipeteknologi.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $tipeteknologi.redirectToPage(host+'/admin/tipeteknologi/create');
});