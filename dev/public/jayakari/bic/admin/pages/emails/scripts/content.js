/**
 * Created by alienware on 1/4/2018.
 */

var askReview = {
    config: {
        batal: $('#batal'),
        kirim: false
    },
    init: function(settings){
        $.extend(askReview.config,settings);
        askReview.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        askReview.init({});
    });
}

$('#kembali').on('click',function(){
    askReview.redirectToPage(host+'/admin/inovator/message/sent');
});