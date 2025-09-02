/**
 * Created by alienware on 12/24/2017.
 */
var actionInInovator = function(){

    var redirectToAddInovator = function (){
        $('#new_inovator').on('click',function(){
            location.href = host+"/admin/inovator/addinovator";
        });
    }

    return {
        init: function() {
            redirectToAddInovator();
        }
    };
}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        actionInInovator.init();
    });
}