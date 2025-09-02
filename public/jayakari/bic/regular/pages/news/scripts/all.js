/**
 * Created by alienware on 1/4/2018.
 */

var berita = {
    config: {
        table: null
    },
    init: function(settings){
        $.extend(berita.config,settings);
        berita.setup();
        //$('#sample_1 thead').css('display:none');
    },
    setup: function(){

        berita.config.table = $('#allnews');

        // begin first table
        berita.config.table.DataTable();

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

jQuery(document).ready(function() {
    berita.init();
});

$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading"); },
    ajaxStop: function() { $body.removeClass("loading"); }
});