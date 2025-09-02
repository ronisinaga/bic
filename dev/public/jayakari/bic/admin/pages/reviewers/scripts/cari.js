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

        $("#selStatus").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        var options={
            format: 'mm/dd/yyyy',
            todayHighlight: true,
            autoclose: true
        };
        $('.datepicker').datepicker(options);
    },
    cariProposal : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/reviewer/proposal/cariProposal',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    if ($.fn.DataTable.isDataTable('#result')){
                        table.destroy();
                    }
                    cari.config.kirim = false;
                    var index = 1;
                    $('#result tbody tr').remove();
                    //var proposal = JSON.parse(response.proposal);
                    var num = response.proposal.length;
                    for(var i=0;i<num;i++){
                        $('#result tbody:last').append('' +
                            '<tr><td>'+index+'</td><td>' + response.proposal[i].id+'</td>' +
                            '<td><a href="'+host+'/admin/reviewer/proposal/'+response.proposal[i].id+'/5/masuk" onClick="window.open(this.href,\'targetWindow\');return false;">' + response.proposal[i].judul+'</a></td>'+
                            '<td>'+response.proposal[i].fullname+'</td><td>'+response.proposal[i].jenis_instansi+'</td>' +
                            '<td>'+response.proposal[i].nama_instansi+'</td><td>'+response.proposal[i].nama_arn+'</td><td>' + response.proposal[i].status+'</td>' +
                            '<td>' + response.proposal[i].created_date+'</td><td>' + response.proposal[i].updated_date+'</td>' +
                            '<td>' + response.proposal[i].email+'</td><td>' + response.proposal[i].hp+'</td><td>' + response.proposal[i].alamat+'</td></tr>');
                        index++;
                        //alert(response.proposal[i].judul);
                    }
                    if (!$.fn.DataTable.isDataTable('#result')){
                        table = $('#result').DataTable({
                            "searching": true,
                            "ordering": true,
                            "paging": true,
                            "info": true
                        });
                    }
                    $('#divResult').css('display','block');
                    toastr["success"]('Tampilkan hasil pencarian','Success');

                }
            },
            error: function (response) {
                alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                //document.write(response.responseText);
            }
        });
    },
    downloadProposal : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/proposal/cariProposalDownload',
            data: {
                data: json
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
    cari.downloadProposal(json);
});