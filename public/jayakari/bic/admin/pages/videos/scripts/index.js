/**
 * Created by alienware on 1/4/2018.
 */

var $videos = {
    config: {

    },
    init: function(settings){
        $.extend($videos.config,settings);
        $videos.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $videos.redirectToPage(host+'/admin/videos/create');
});