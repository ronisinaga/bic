/**
 * Created by alienware on 1/4/2018.
 */

var blog = {
    config: {
        table: null
    },
    init: function(settings){
        $.extend(blog.config,settings);
        blog.setup();
        //$('#sample_1 thead').css('display:none');
    },
    setup: function(){

        blog.config.table = $('#allnews');

        // begin first table
        blog.config.table.DataTable();

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

jQuery(document).ready(function() {
    blog.init();
});

$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading"); },
    ajaxStop: function() { $body.removeClass("loading"); }
});