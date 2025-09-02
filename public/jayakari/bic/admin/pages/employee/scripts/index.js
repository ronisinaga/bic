/**
 * Created by alienware on 1/4/2018.
 */

var $employee = {
    config: {

    },
    init: function(settings){
        $.extend($employee.config,settings);
        $employee.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    $employee.redirectToPage(host+'/admin/employee/create');
});