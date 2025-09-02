/**
 * Created by alienware on 1/4/2018.
 */

var listusers = {
    config: {

    },
    init: function(settings){
        $.extend(listusers.config,settings);
        listusers.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    listusers.redirectToPage(host+'/admin/users/create');
});