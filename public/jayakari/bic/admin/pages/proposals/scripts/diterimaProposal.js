/**
 * Created by alienware on 1/4/2018.
 */

var proposal = {
    config: {
        valid: false
    },
    init: function (settings) {
        $.extend(proposal.config, settings);
        proposal.setup();
    },
    setup: function () {

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "onHidden": function () {
                if (proposal.config.valid) {
                    proposal.redirectToPage(host+'/admin/adminproses/proposal');
                }
            },
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

    },
    redirectToPage : function(page){
        window.location = page;
    }
}

$('#sample_1').on('click','#send',function(){
    var rows = $(this).closest('tr');
    var td = $(rows).find('td');
    proposal.redirectToPage(host+'/admin/adminproses/proposal/'+$(td[1]).text()+'/terima');
});