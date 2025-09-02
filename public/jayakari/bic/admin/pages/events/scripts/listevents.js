/**
 * Created by alienware on 1/4/2018.
 */

var listevents = {
    config: {

    },
    init: function(settings){
        $.extend(listevents.config,settings);
        listevents.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new_event').on('click',function(){
    listevents.redirectToPage(host+'/admin/events/addevent');
});

$('#edit').on('click',function(){
    listevents.redirectToPage(host+'/admin/events/editEvent');
});

$('#delete').on('click',function(){
    listevents.redirectToPage(host+'/admin/events/deleteEvent');
});

$('#gambar').on('click',function(){
    listevents.redirectToPage(host+'/admin/events/selectedEventImage');
});