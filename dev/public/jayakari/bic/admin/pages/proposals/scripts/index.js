/**
 * Created by alienware on 1/4/2018.
 */

var index = {
    config: {

    },
    init: function(settings){
        $.extend(index.config,settings);
        index.setup();
    },
    setup: function(){

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "onHidden": function() {
                if (index.config.kirim){
                    $('#popupBatal').modal('hide');
                    index.redirectToPage(host+'/admin/inovator/proposal');
                }
                //
            },
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    },

    ubahStatus : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/proposal/ubahBatalToNew',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    toastr['success']("Sistem berhasil ubah status proposal menjadi new","Success");
                }
            },
            error: function (response) {
                //alert(response.responseText);
                document.write(response.responseText);
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        index.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#new').on('click',function(){
    index.redirectToPage(host+'/admin/inovator/proposal/create');
});

$('#sample_1').on('click','#change',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var json = '{"sender":"bic","id":"'+$($cols[1]).text()+'"}';
    index.ubahStatus(json);
    $($cols[5]).html('BARU');
    $($cols[6]).html('<a href="'+host+'/admin/inovator/proposal/'+$($cols[1]).text()+'/edit" class="btn blue"><i class="fa fa-pencil"></i> Edit Judul </a><a href="'+host+'/admin/inovator/proposal/'+$($cols[1]).text()+'/lengkapi" class="btn red"><i class="fa fa-adjust"></i> Lengkapi </a>');
});