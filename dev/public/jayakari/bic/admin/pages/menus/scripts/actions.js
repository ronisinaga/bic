/**
 * Created by alienware on 12/24/2017.
 */
var actionInMenugroupPage = function(){
    var redirectToAddMenuGroup = function (){
        $('#sample_editable_1_new').on('click',function(){
            location.href = host+"/admin/menus/addmenugroup";
        });
    };

    var redirectToAddMenu = function (){
        $('#new_menu').on('click',function(){
            location.href = host+"/admin/menus/addmenu";
        });
    }

    return {
        init: function() {
            redirectToAddMenuGroup();
            redirectToAddMenu();
        }
    };
}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        actionInMenugroupPage.init();
    });
}