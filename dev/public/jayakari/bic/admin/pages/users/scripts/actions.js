/**
 * Created by alienware on 12/24/2017.
 */
var actionInUsergroupPage = function(){
    var redirectToAddUserGroup = function (){
        $('#sample_editable_1_new').on('click',function(){
            location.href = host+"/admin/users/addusergroup";
        });
    };

    var redirectToAddUsers = function (){
        $('#new_user').on('click',function(){
            location.href = host+"/admin/users/adduser";
        });
    }

    return {
        init: function() {
            redirectToAddUserGroup();
            redirectToAddUsers();
        }
    };
}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        actionInUsergroupPage.init();
    });
}