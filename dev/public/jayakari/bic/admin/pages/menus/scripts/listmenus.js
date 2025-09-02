/**
 * Created by alienware on 1/4/2018.
 */

var listmenus = {
    config: {

    },
    init: function(settings){
        $.extend(listmenus.config,settings);
        listmenus.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    listmenus.redirectToPage(host+'/admin/menus/create');
});