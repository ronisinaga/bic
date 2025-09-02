/**
 * Created by alienware on 1/4/2018.
 */

var review = {
    config: {
        kirim : false,
        table : null
    },
    init: function(settings){
        $.extend(review.config,settings);
        review.setup();
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
                if (review.config.kirim){
                    review.redirectToPage(host+'/admin/adminproses/proposal/sudahreview');
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

        $("#selStatus").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },
    saveReview : function(json){
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
                if (response.status == "success"){
                    review.config.kirim = true;
                    toastr["success"]('Berhasil simpan review yang berkaitan dengan proposal inovasi','Success');
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
                    review.config.kirim = false;
                    var index = 1;
                    $('#result tbody tr').remove();
                    //var proposal = JSON.parse(response.proposal);
                    var num = response.proposal.length;
                    for(var i=0;i<num;i++){
                        /*$('#sample_1 tbody:last').append('<tr><td>'+index+'</td><td>'+response.proposal[i].id+'</td><td>' + response.proposal[i].judul+'</td><td>'
                            + response.proposal[i].abstrak+'</td><td>' + response.proposal[i].deskripsi+'</td><td>'+ response.proposal[i].keunggulan_teknologi+'</td><td>'
                            + response.proposal[i].potensi_aplikasi+'</td><td>' + response.proposal[i].status+'</td></tr>');*/
                        /*$('#sample_1 tbody:last').append('<tr><td>'+index+'</td><td>'+response.proposal[i].id+'</td><td>' + response.proposal[i].judul+'</td><td>'
                         + response.proposal[i].abstrak+'</td><td>' + response.proposal[i].deskripsi+'</td><td>' + response.proposal[i].status+'</td></tr>');*/
                        $('#result tbody:last').append('' +
                            '<tr><td width="20px">'+index+'</td>' +
                            '<td width="100px">'+response.proposal[i].fullname+'</td>' +
                            '<td width="50px">' + response.proposal[i].status+'</td>' +
                            '<td width="20px">' + response.proposal[i].id+'</td>' +
                            '<td width="400px"><a href="'+host+'/admin/reviewer/proposal/'+response.proposal[i].id+'/5/masuk" onClick="window.open(this.href,\'targetWindow\');return false;">' + response.proposal[i].judul+'</a></td></tr>');
                        index++;
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

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        review.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnreview').on('click',function(){
    var arr = {
        "sender":"bic",
        "id_proposal":$('#id').val(),
        "isi":CKEDITOR.instances['review'].getData(),
        "status":$('#selStatus').val()
    };
    var json = JSON.stringify(arr);
    review.saveReview(json);
});

$('#tblHistory').on('click','#detailMessage',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var isi = $($cols[5]).html();
    $('#isi').empty();
    $('#isi').append('<label class="control-label"><b>Isi Review</b></label><div class="keterangan"><table class="table table-striped table-bordered table-hover"><tbody><tr><td>'+isi+'</td></tr></tbody></table></div>');
});

$('#btnLookup').on('click',function(){
    $('#popupLookUp').modal();
});

$('#btnPopupCari').on('click',function(){
    var json= '{"sender":"bic"' +
        ',"nama_inovator":"'+$('#popupNamaInovator').val()+'"' +
        ',"nomor_proposal":"'+$('#popupNomorProposal').val()+'"' +
        ',"judul_proposal":"'+$('#popupJudulProposal').val()+'"' +
        ',"keyword_proposal":"'+$('#popupKeywordProposal').val()+'"' +
        ',"status_proposal":"'+$('#selPopupStatusProposal').val()+'"}';
    review.cariProposal(json);
});