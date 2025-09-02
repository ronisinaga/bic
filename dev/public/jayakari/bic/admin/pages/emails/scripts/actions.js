/**
 * Created by alienware on 12/24/2017.
 */
var actionInEmailPage = function(){

    var redirectToNewEmail = function (){
        $('#new_email').on('click',function(){
            location.href = host+'/admin/email/newemail';
        });
    }

    return {
        init: function() {
            redirectToNewEmail();
        }
    };
}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        actionInEmailPage.init();
    });
}