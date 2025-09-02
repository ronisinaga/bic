/**
 * Created by alienware on 1/4/2018.
 */

var addpenilai = {
    config: {

    },
    init: function(settings){
        $.extend(addpenilai.config,settings);
        addpenilai.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#btnSimpan').on('click',function(){
    addpenilai.redirectToPage(host+'/admin/penilai/listpenilai');
});

$('#btnBatal').on('click',function(){
    addpenilai.redirectToPage(host+'/admin/penilai/listpenilai');
});