/**
 * Created by alienware on 1/4/2018.
 */

var juri = {
    config: {

    },
    init: function(settings){
        $.extend(juri.config,settings);
        juri.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    juri.redirectToPage(host+'/admin/adminproses/juri/create');
});