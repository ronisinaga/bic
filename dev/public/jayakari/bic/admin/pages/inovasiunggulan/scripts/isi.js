/**
 * Created by alienware on 1/4/2018.
 */

var cari = {
    config: {
        kirim : false,
        table: null,
        tableResult : null
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

        $("#selARN").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
        $("#selStatusPaten").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        $("#selKesiapanInovasi").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        $("#selKerjasamaBisnis").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        $("#selPeringkatInovasi").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
        cari.config.table = $('#sample_1').DataTable({
            "searching": true,
            "ordering": true,
            "paging": true,
            "info": true
        });
    },
    cariIsiBuku : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovasi/unggulan/cari',
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
                        cari.config.tableResult.destroy();
                    }
                    cari.config.kirim = false;
                    var index = 1;
                    $('#result tbody tr').remove();
                    //var proposal = JSON.parse(response.proposal);
                    var num = response.isibuku.length;
                    for(var i=0;i<num;i++){
                        var disabled = "";
                        var numIsiInovasi = response.isiInovasi.length;
                        var found = false;
                        for(var j=0;j<numIsiInovasi&&!found;j++){
                            if(response.isiInovasi[j].id_isi_buku == response.isibuku[i].id){
                                found = true;
                            }
                        }
                        if (found){
                            disabled = "disabled";
                        }
                        $('#result tbody:last').append('' +
                            '<tr><td width="20px">'+index+'</td>' +
                            '<td>'+response.isibuku[i].judul_singkat+'</td>' +
                            '<td>' + response.isibuku[i].short_title+'</td>' +
                            '<td>' + response.isibuku[i].judul_lengkap+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].deskripsi_singkat+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].short_description+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].perspektif+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].keunggulan_inovasi+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].potensi_aplikasi+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].inovator+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].institusi+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].id_paten+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].id_kesiapan_inovasi+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].id_kerjasama_bisnis+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].id_peringkat_inovasi+'</td>' +
                            '<td style="display:none">' + response.isibuku[i].id+'</td>' +
                            '<td>'+
                            '<button id="pilih" name="pilih" class="btn btn-primary" '+disabled+'><i class="fa fa-check"></i> Pilih</button>'+
                            '<button id="lihat" name="lihat" class="btn btn-danger"><i class="fa fa-eye"></i> Lihat</button>'+
                            '</td></tr>'
                        );
                        index++;
                    }
                    if (!$.fn.DataTable.isDataTable('#result')){
                        cari.config.tableResult = $('#result').DataTable({
                            "searching": true,
                            "ordering": true,
                            "paging": true,
                            "info": true
                        });
                    }
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
    simpanIsiBuku : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovasi/unggulan/simpan',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    if ($.fn.DataTable.isDataTable('#sample_1')){
                        cari.config.table.destroy();
                    }
                    cari.config.kirim = false;
                    var index = 1;
                    $('#sample_1 tbody tr').remove();
                    //var proposal = JSON.parse(response.proposal);
                    var num = response.isiInovasi.length;
                    for(var i=0;i<num;i++){
                        $('#sample_1 tbody:last').append('' +
                            '<tr><td width="20px">'+index+'</td>' +
                            '<td>'+response.isiInovasi[i].tema+'</td>' +
                            '<td>'+response.isiInovasi[i].judul_singkat+'</td>' +
                            '<td>' + response.isiInovasi[i].short_title+'</td>' +
                            '<td>' + response.isiInovasi[i].judul_lengkap+'</td>' +
                            '<td style="display: none;">' + response.isiInovasi[i].id+'</td>' +
                            '<td><button id="hapus" name="lihat" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button></td></tr>'
                        );
                        index++;
                    }
                    if (!$.fn.DataTable.isDataTable('#sample_1')){
                        cari.config.table = $('#sample_1').DataTable({
                            "searching": true,
                            "ordering": true,
                            "paging": true,
                            "info": true
                        });
                    }
                    $('#result > tbody > tr').each(function(){
                        var id = $(this).find('td').eq(15).text();
                        var found = false;
                        for(var i=0;i<num&&!found;i++){
                            if (parseInt(id) == response.isiInovasi[i].id_isi_buku){
                                found = true;
                            }
                        }
                        if (found){
                            var button = '<button id="pilih" name="pilih" class="btn btn-primary" disabled><i class="fa fa-check"></i> Pilih</button>';
                            button += '<button id="lihat" name="lihat" class="btn btn-danger"><i class="fa fa-eye"></i> Lihat</button>';
                            $(this).find('td').eq(16).html(button);
                        }else{
                            var button = '<button id="pilih" name="pilih" class="btn btn-primary"><i class="fa fa-check"></i> Pilih</button>';
                            button += '<button id="lihat" name="lihat" class="btn btn-danger"><i class="fa fa-eye"></i> Lihat</button>';
                            $(this).find('td').eq(16).html(button);
                        }
                    });
                    toastr["success"]('Tampilkan hasil pencarian','Success');

                }
            },
            error: function (response) {
                //alert(response.responseText);
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
        cari.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnCari').on('click',function(){
    var json= '{"sender":"bic"' +
        ',"id":"'+$('#id').val()+'"' +
        ',"arn":"'+$('#selARN').val()+'"' +
        ',"irc":"'+$('#selIRC').val()+'"' +
        ',"aplikasi":"'+$('#selAplikasi').val()+'"' +
        ',"judul_singkat":"'+$('#judul_singkat').val()+'"' +
        ',"judul_lengkap":"'+$('#judul_lengkap').val()+'"' +
        ',"keyword":"'+$('#keyword').val()+'"' +
        ',"status_paten":"'+$('#selStatusPaten').val()+'"' +
        ',"kesiapan_inovasi":"'+$('#selKesiapanInovasi').val()+'"' +
        ',"kerjasama_bisnis":"'+$('#selKerjasamaBisnis').val()+'"' +
        ',"peringkat_inovasi":"'+$('#selPeringkatInovasi').val()+'"' +
        ',"short_title":"'+$('#short_title').val()+'"}';
    cari.cariIsiBuku(json);
});

$('#result').on('click','#lihat',function(){
    var row = $(this).closest('tr');
    var cols = row.find('td');
    $('.modal-title').empty();
    $('.modal-title').html('Detail '+$(cols[1]).text());
    $('.modal-body').empty();
    var table = '<table class="table table-striped table-bordered table-hover" id="popupTable" name="popupTable">';
    table += '<tbody>';
    table += '<tr>';
    table += '<td>Judul Singkat</td>';
    table += '<td>'+$(cols[1]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Short Title</td>';
    table += '<td>'+$(cols[2]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Judul Lengkap</td>';
    table += '<td>'+$(cols[3]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Deskripsi Singkat</td>';
    table += '<td>'+$(cols[4]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Short Description</td>';
    table += '<td>'+$(cols[5]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Perspektif</td>';
    table += '<td>'+$(cols[6]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Keunggulan Inovasi</td>';
    table += '<td>'+$(cols[7]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Potensi Aplikasi</td>';
    table += '<td>'+$(cols[8]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Inovator</td>';
    table += '<td>'+$(cols[9]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    table += '<td>Insitusi</td>';
    table += '<td>'+$(cols[10]).text()+'</td>';
    table += '</tr>';
    table += '<tr>';
    var paten = '';
    switch ($(cols[11]).text()){
        case '1':
            paten = 'Telah Terdaftar';
            break;
        case '2':
            paten = 'Dalam Prose Pengajuan';
            break;
        case '3':
            paten = 'Belum Didaftarkan';
            break;
        case '4':
            paten = 'Tidak Ingin Didaftarkan';
            break;
    }
    table += '<td>Status Paten</td>';
    table += '<td>'+paten+'</td>';
    table += '</tr>';
    table += '<tr>';
    var kesiapan_inovasi = '';
    switch ($(cols[12]).text()){
        case '1':
            kesiapan_inovasi = '*** Telah Dikomersialkan';
            break;
        case '2':
            kesiapan_inovasi = '** Siap Dikomersialkan';
            break;
        case '3':
            kesiapan_inovasi = '* Prototype';
            break;
    }
    table += '<td>Kesiapan Inovasi</td>';
    table += '<td>'+kesiapan_inovasi+'</td>';
    table += '</tr>';
    table += '<tr>';
    var kerjasama_bisnis = '';
    switch ($(cols[13]).text()){
        case '1':
            kerjasama_bisnis = '*** Terbuka';
            break;
        case '2':
            kerjasama_bisnis = '** Luas';
            break;
        case '3':
            kerjasama_bisnis = '* Terbatas';
            break;
    }
    table += '<td>Kerjasama Bisnis</td>';
    table += '<td>'+kerjasama_bisnis+'</td>';
    table += '</tr>';
    table += '<tr>';
    var peringkat_inovasi = '';
    switch ($(cols[14]).text()){
        case '1':
            peringkat_inovasi = '*** Paling Prospektif';
            break;
        case '2':
            peringkat_inovasi = '** Sangat Prospektif';
            break;
        case '3':
            peringkat_inovasi = '* Prospektif';
            break;
    }
    table += '<td>Peringkat Inovasi</td>';
    table += '<td>'+peringkat_inovasi+'</td>';
    table += '</tr>';
    table += '</tbody>';
    table += '</table>';
    $('.modal-body').html(table);
    $('#popupIsiBuku').modal();
});

$('#result').on('click','#pilih',function(){
    var row = $(this).closest('tr');
    var cols = row.find('td');
    var json= '{"sender":"bic","id":'+$('#id').val()+',"id_isi_buku":'+$(cols[15]).text()+'}';
    cari.simpanIsiBuku(json);
});