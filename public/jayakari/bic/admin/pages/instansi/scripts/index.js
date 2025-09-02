/**
 * Created by alienware on 1/4/2018.
 */

var $instansi = {
    config: {

    },
    init: function(settings){
        $.extend($instansi.config,settings);
        $instansi.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $instansi.redirectToPage(host+'/admin/instansi/create');
});