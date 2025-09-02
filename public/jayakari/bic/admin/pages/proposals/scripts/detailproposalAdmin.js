/**
 * Created by alienware on 1/4/2018.
 */

var reviewproposal = {
    config: {

    },
    init: function(settings){
        $.extend(reviewproposal.config,settings);
        reviewproposal.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#btnBatal').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/inovator/proposal');
});

$('#batalBawah').on('click',function(){
    reviewproposal.redirectToPage(host+'/admin/inovator/proposal');
});

$('#tblHistory').on('click','#detailMessage',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var isi = $($cols[5]).text();
    $('#isi').empty();
    $('#isi').append('<label class="control-label"><b>Isi Review</b></label><div class="keterangan"><table class="table table-striped table-bordered table-hover"><tbody><tr><td>'+isi+'</td></tr></tbody></table></div>');
});

$('#tblHistoryBawah').on('click','#detailMessageBawah',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var isi = $($cols[5]).text();
    $('#isiBawah').empty();
    $('#isiBawah').append('<label class="control-label"><b>Isi Review</b></label><div class="keterangan"><table class="table table-striped table-bordered table-hover"><tbody><tr><td>'+isi+'</td></tr></tbody></table></div>');
});