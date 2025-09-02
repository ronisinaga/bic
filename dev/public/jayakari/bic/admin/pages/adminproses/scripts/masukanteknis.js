/**
 * Created by alienware on 1/4/2018.
 */

var masukanteknis = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(masukanteknis.config,settings);
        masukanteknis.setup();
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
                if (masukanteknis.config.valid){
                    masukanteknis.redirectToPage(host+'/admin/adminproses/proposal/expert/review');
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
        };

    },

    valid: function(){
        masukanteknis.config.valid = true;
        if ($('#selJuri').val() == '0'){
            toastr['error']('Juri harus dipilih','Error');
            masukanteknis.config.valid = false;
        }
        return masukanteknis.config.valid;
    },

    save: function(json){
        if (masukanteknis.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/adminproses/proposal/masukanteknis',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil mengirimkan permohonan masukan teknis kepada juri","Success");
                    }
                },
                error: function (response) {
                    document.write(response.responseText);
                    //toastr['error'](response.responseText,"Error");
                }
            });
        }
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        masukanteknis.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //masukanteknis.redirectToPage(host+'/admin/masukanteknis');
    var arr = {
        "sender":"bic",
        "id_proposal":$("#id").val(),
        "id_juri_old":$("#juriid").val(),
        "id_juri":$("#selJuri").val(),
        "isi":$("#pesan").val()
    }
    var json= JSON.stringify(arr);
    //alert(json);
    masukanteknis.save(json);
});

$('#btnBatal').on('click',function(){
    masukanteknis.redirectToPage(host+'/admin/adminproses/proposal/expert/review');
});