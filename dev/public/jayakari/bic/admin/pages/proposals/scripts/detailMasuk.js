/**
 * Created by alienware on 1/4/2018.
 */

var detailMasuk = {
    config: {

    },
    init: function(settings){
        $.extend(detailMasuk.config,settings);
        detailMasuk.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#btnBatal').on('click',function(){
    switch ($('#tahapan').val()){
        case "2":
            detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/masuk');
            break;
        case "3":
            detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/belumreview');
            break;
        case "4":
            detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/revisi');
            break;
        case "5":
            detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/sudahreview');
            break;
        case "6":
            detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/seleksi');
            break;
        case "7":
            detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/disimpan');
            break;
        case "8":
            detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/diterima');
            break;
        case "9":
            detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/ditolak');
            break;
    }
});

$('#review').on('click',function(){
    detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/'+$('#id').val()+'/review');
});

$('#batalBawah').on('click',function(){
    detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/masuk');
});

$('#reviewBawah').on('click',function(){
    detailMasuk.redirectToPage(host+'/admin/reviewer/proposal/'+$('#id').val()+'/review');
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