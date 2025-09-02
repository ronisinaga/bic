/**
 * Created by alienware on 1/4/2018.
 */

var topik = {
    config: {

    },
    init: function(settings){
        $.extend(topik.config,settings);
        topik.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    topik.redirectToPage(host+'/admin/topik/create');
});