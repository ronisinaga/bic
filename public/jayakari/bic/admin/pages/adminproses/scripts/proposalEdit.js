/**
 * Created by alienware on 1/4/2018.
 */

var proposal = {
    config: {
        valid: false
    },
    init: function(settings){
        $.extend(proposal.config,settings);
        proposal.setup();
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
                if (proposal.config.valid){
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
    valid : function(){
        proposal.config.valid = true;
        if ($('#selBatch').val() == "0"){
            proposal.config.valid = false;
            toastr["error"]("Batch harus dipilih","Error");
        }

        if ($('#selTopik').val() == "0"){
            proposal.config.valid = false;
            toastr["error"]("Topik harus dipilih","Error");
        }
        return proposal.config.valid;
    },
    loadTopik : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/findTopik',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                var len = response.length;
                if (len != 0){
                    $('#selTopik').empty().append("<option value='0'>-- Pilih Topik --</option>");
                    for(var i=0;i<len;i++){
                        $('#selTopik').append("<option value='"+response[i].id+"'> "+response[i].topik+"</options>");
                    }

                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    toastr["info"]('Tidak ada topik pada batch ini','Info');
                }
            },
            error: function (response) {
                alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                //$('#loadingDiv').removeClass('show');
                //$('#loadingDiv').addClass('hide');
                //document.write(response.responseText);
            }
        });
    },

    saveProposal : function(json){
        if (proposal.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/adminproses/proposal/edit',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    var len = response.length;
                    if (response.status == "success"){
                        toastr["success"]('Data edit assign proposal ke topik berhasil dilakukan ke dalam basisdata','Sukses');

                    }else if (response.status == "exist"){
                        //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                        proposal.config.valid = false;
                        toastr["info"]('Proposal '+$('#selProposal option:selected').text()+' sudah ditambahkan kedalam topik '+$('#selTopik option:selected').text(),'Info');
                    }
                },
                error: function (response) {
                    alert(response.responseText);
                    //toastr['error'](response.responseText,"Error");
                    //$('#loadingDiv').removeClass('show');
                    //$('#loadingDiv').addClass('hide');
                    //document.write(response.responseText);
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
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var json = '{"sender":"bic","id":'+$('#id').val()+',"id_batch":'+$('#selBatch').val()+',"id_topik":'+$('#selTopik').val()+',"id_proposal":'+$('#id_proposal').val()+'}';
    proposal.saveProposal(json);
});

$('#btnBatal').on('click',function(){
    proposal.redirectToPage(host+'/admin/adminproses/proposal');
});

$('#btnView').on('click',function(){
    $('#popupViewProposal').modal();
});

$('#selBatch').on('change',function(){
    var json = '{"sender":"bic","id":'+$('#selBatch').val()+'}';
    proposal.loadTopik(json);
});