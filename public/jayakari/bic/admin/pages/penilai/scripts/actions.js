/**
 * Created by alienware on 12/24/2017.
 */
var actionInUsergroupPage = function(){

    var redirectToAddUsers = function (){
        $('#new_penilai').on('click',function(){
            location.href = host+"/admin/penilai/addpenilai";
        });
    }

    return {
        init: function() {
            redirectToAddUsers();
        }
    };
}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        actionInUsergroupPage.init();
    });
}