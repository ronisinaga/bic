/**
 * Created by alienware on 1/4/2018.
 */

var content = {
    config: {
        batal: $('#batal'),
        kirim: false
    },
    init: function(settings){
        $.extend(content.config,settings);
        content.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        content.init({});
    });
}

$('#kembali').on('click',function(){
    content.redirectToPage(host+'/admin/adminproses/message/sent');
});