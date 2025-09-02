/**
 * Created by alienware on 1/4/2018.
 */

var video = {
    config: {
        table: null
    },
    init: function(settings){
        $.extend(video.config,settings);
        video.setup();
        //$('#sample_1 thead').css('display:none');
    },
    setup: function(){

        video.config.table = $('#allvideos');

        // begin first table
        video.config.table.dataTable();

        $('.video').magnificPopup({
            delegate:'a',
            type:'iframe'
        });

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

jQuery(document).ready(function() {
    video.init();
});

$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading"); },
    ajaxStop: function() { $body.removeClass("loading"); }
});