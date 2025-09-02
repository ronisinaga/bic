/**
 * Created by alienware on 1/4/2018.
 */

var cari = {
    config: {
        kirim : false,
        table : null
    },
    init: function(settings){
        $.extend(cari.config,settings);
        cari.setup();
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
                if (cari.config.kirim){
                    //cari.redirectToPage(host+'/admin/adminproses/proposal/sudahcari');
                }
            },
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    },
    downloadProposal : function(){
        $.ajax({
            method: 'POST',
            url: host+'/admin/blast/daftarinovator/download',
            data: {
                data: ''
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    toastr["success"]('Download','Success');
                    cari.redirectToPage(host+'/admin/proposal/download/'+response.filename);
                }
            },
            error: function (response) {
                alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                //document.write(response.responseText);
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        cari.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnCari').on('click',function(){
    var arr = {
        "sender":"BIC",
        "nama_inovator":$('#namaInovator').val().trim(),
        "nomor_awal":$('#nomorAwal').val().trim(),
        "nomor_akhir":$('#nomorAkhir').val().trim(),
        "judul_proposal":$('#judulProposal').val().trim(),
        "keyword_proposal":$('#keywordProposal').val().trim(),
        "status_proposal":$('#selStatusProposal').val().trim(),
        "start":$('#start').val().trim(),
        "end":$('#end').val().trim()
    };
    var json = JSON.stringify(arr);
    cari.cariProposal(json);
});

$('#download').on('click',function(){
    cari.downloadProposal();
});