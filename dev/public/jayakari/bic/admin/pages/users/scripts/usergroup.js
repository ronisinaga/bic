/**
 * Created by alienware on 1/4/2018.
 */

var addusergroup = {
    config: {

    },
    init: function(settings){
        $.extend(addusergroup.config,settings);
        addusergroup.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    addusergroup.redirectToPage(host+'/admin/usergroup/create');
});