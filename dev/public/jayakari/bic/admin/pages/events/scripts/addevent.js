/**
 * Created by alienware on 1/4/2018.
 */

var addmenu = {
    config: {

    },
    init: function(settings){
        $.extend(addmenu.config,settings);
        addmenu.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#btnSimpan').on('click',function(){
    addmenu.redirectToPage(host+'/admin/events/listevents');
});

$('#btnBatal').on('click',function(){
    addmenu.redirectToPage(host+'/admin/events/listevents');
});