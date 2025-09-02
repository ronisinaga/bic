/**
 * Created by alienware on 1/4/2018.
 */

var pilihjuri = {
    config: {

    },
    init: function(settings){
        $.extend(pilihjuri.config,settings);
        pilihjuri.setup();
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

    saveKatakKunci : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/proposal/pilihjuri',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    toastr['success']("Sistem berhasil menambahkan data kedalam database","Success");

                }else{
                    num = response.exist.length;
                    var juri = "";
                    for(var i=0;i<num;i++){
                        if (i == num-1){
                            juri += response.exist[i];
                        }else{
                            juri += response.exist[0]+', ';
                        }
                    }
                    toastr['success']("Sistem berhasil menambahkan data kedalam database dengan catatan juri berikut :"+juri+" sudah menjadi juri untuk proposal ini","Success");
                }
                var num =  response.juri.length;
                $("#tblJuri tbody > tr").empty();
                for(var i=0;i<num;i++){
                    var index = i+1;
                    $("#tblJuri tbody:last").append('<tr><td>'+index+'</td><td style="display: none">'+response.juri[i].id+'</td><td>'+response.juri[i].fullname+'</td><td><button type="button" class="btn red" id="deleteJuri" name="deleteJuri"><i class="fa fa-remove"></i> Hapus</button></td>');
                }
            },
            error: function (response) {
                //toastr['error'](response.responseText,"Error");
                document.write(response.responseText);
            }
        });
    },
    saveJuri:function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/proposal/pilihjuri',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    toastr['success']("Sistem berhasil menambahkan data kedalam database","Success");

                }else{
                    num = response.exist.length;
                    var juri = "";
                    for(var i=0;i<num;i++){
                        if (i == num-1){
                            juri += response.exist[i];
                        }else{
                            juri += response.exist[0]+', ';
                        }
                    }
                    toastr['success']("Sistem berhasil menambahkan data kedalam database dengan catatan juri berikut :"+juri+" sudah menjadi juri untuk proposal ini","Success");
                }
                var num =  response.juri.length;
                $("#tblJuri tbody > tr").empty();
                for(var i=0;i<num;i++){
                    var index = i+1;
                    $("#tblJuri tbody:last").append('<tr><td>'+index+'</td><td style="display: none">'+response.juri[i].id+'</td><td>'+response.juri[i].fullname+'</td><td><button type="button" class="btn red" id="deleteJuri" name="deleteJuri"><i class="fa fa-remove"></i> Hapus</button></td>');
                }
            },
            error: function (response) {
                //toastr['error'](response.responseText,"Error");
                document.write(response.responseText);
            }
        });
    },
    deleteJuri:function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/proposal/deletejuri',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    toastr['success']("Juri berhasil dihapus dari basisdata penjurian","Success");
                    var num =  response.juri.length;
                    $("#tblJuri tbody tr").empty();
                    for(var i=0;i<num;i++){
                        var index = i+1;
                        $("#tblJuri tbody:last").append('<tr><td>'+index+'</td><td style="display: none">'+response.juri[i].id+'</td><td>'+response.juri[i].fullname+'</td><td><button type="button" class="btn red" id="deleteJuri" name="deleteJuri"><i class="fa fa-remove"></i> Hapus</button></td>');
                    }
                }
            },
            error: function (response) {
                //toastr['error'](response.responseText,"Error");
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
        pilihjuri.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnBatal').on('click',function(){
    pilihjuri.redirectToPage(host+'/admin/adminproses/proposal/sudahreview');
});

$('#batalBawah').on('click',function(){
    pilihjuri.redirectToPage(host+'/admin/adminproses/proposal/sudahreview');
});

$('#tambahKataKunci').on('click',function(){
    var json = '{"sender":"bic","id_proposal":'+$('#id').val()+',"kategori":'+$('#selKategori').val()+',"kata_kunci":'+$('#selKataKunciTeknologi').val()+'}';
    pilihjuri.saveKatakKunci(json);
});

$('#tambahDewanJuri').on('click',function(){
    var json = '{"sender":"bic","id_proposal":'+$('#id').val()+',"kategori":'+$('#selKategori').val()+',"juri":'+$('#selDewanJuri').val()+'}';
    pilihjuri.saveJuri(json);
});

$('#hapusDewanJuri').on('click',function(){
    pilihjuri.redirectToPage(host+'/admin/reviewer/proposal/'+$('#id').val()+'/review');
});

$('#tblHistory').on('click','#detailMessage',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var isi = $($cols[5]).text();
    $('#isi').empty();
    $('#isi').append('<label class="control-label"><b>Isi Review</b></label><div class="keterangan"><table class="table table-striped table-bordered table-hover"><tbody><tr><td>'+isi+'</td></tr></tbody></table></div>');
});

$('#selKategori').on('change',function(){
    var val = $('#selKategori').val();
    switch (val){
        case "1":
            $('#kataKunciTeknologi').css('display','block');
            $('#dewanjuri').css('display','none');
            break;
        case "2":
            $('#kataKunciTeknologi').css('display','none');
            $('#dewanjuri').css('display','block');
            break;
    }
});

$('#tblJuri').on('click','#deleteJuri',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var id = $($cols[1]).text();
    var json = '{"sender":"bic","id_proposal":'+$('#id').val()+',"juri":'+id+'}';
    pilihjuri.deleteJuri(json);
    $(this).closest('tr').remove();
    //$(this).parents('tr').first().remove();
});