/**
 * Created by alienware on 1/4/2018.
 */

var addinovator = {
    config: {

    },
    init: function(settings){
        $.extend(addinovator.config,settings);
        addinovator.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#btnSimpan').on('click',function(){
    addinovator.redirectToPage(host+'/admin/inovator/listinovators');
});

$('#btnBatal').on('click',function(){
    addinovator.redirectToPage(host+'/admin/inovator/listinovators');
});