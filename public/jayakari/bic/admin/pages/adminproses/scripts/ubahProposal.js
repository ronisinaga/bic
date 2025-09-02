/**
 * Created by alienware on 1/4/2018.
 */

var proposal = {
    config: {
        valid: true
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
                    //alert('Muncul');
                    proposal.redirectToPage(host+'/admin/adminproses/proposal/disimpan');
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
        }

        $("#selStatus").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },
    valid: function(){
        proposal.config.valid = true;
        if ($('#selStatus').val() == '0'){
            proposal.config.valid = false;
            toastr["error"]('Status belum dipilih. Silahkan pilih terlebih dahulu status proposal yang diinginkan','Error');
        }
        if (CKEDITOR.instances['isi'].getData() == ''){
            proposal.config.valid = false;
            toastr["error"]('Anda belum menuliskan pesan ke inovator. Silahkan isi pesan anda kepada inovator','Error');
        }
        return proposal.config.valid;
    },
    ubahProposal : function(json){
        if (proposal.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/adminproses/proposal/review',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status=="success"){
                        proposal.config.valid = true;
                        toastr["success"]('Sukses ubah status proposal','Sukses');

                    }else{
                        //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                        toastr["info"]('Tidak ada proposal pada batch ini','Info');
                    }
                },
                error: function (response) {
                    //alert(response.responseText);
                    //toastr['error'](response.responseText,"Error");
                    document.write(response.responseText);
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
        proposal.init();
    });
    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("processing");    },
        ajaxStop: function() { $body.removeClass("processing"); }
    });
}

$('#btnreview').on('click',function(){
    var rows = $(this).closest('tr');
    var arr = {
        "sender":"bic",
        "id_proposal":$('#id').val(),
        "status":$('#selStatus').val(),
        "isi":CKEDITOR.instances['isi'].getData()
    }
    var json = JSON.stringify(arr);
    proposal.ubahProposal(json);
});

$('#batal').on('click',function(){
    proposal.redirectToPage(host+'/admin/adminproses/proposal/disimpan');
});