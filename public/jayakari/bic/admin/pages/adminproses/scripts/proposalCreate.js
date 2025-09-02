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
        if ($('#selProposal').val() == "0"){
            proposal.config.valid = false;
            toastr["error"]("Proposal harus dipilih","Error");
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
                url: host+'/admin/adminproses/proposal/create',
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
                        toastr["success"]('Data assign proposal berhasil ditambahkan ke dalam basisdata','Sukses');

                    }else if (response.status == "exist"){
                        //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                        proposal.config.valid = false;
                        toastr["info"]('Proposal '+$('#selProposal option:selected').text()+' sudah ditambahkan kedalam topik '+$('#selTopik option:selected').text(),'Info');
                    }
                },
                error: function (response) {
                    //alert(response.responseText);
                    //toastr['error'](response.responseText,"Error");
                    //$('#loadingDiv').removeClass('show');
                    //$('#loadingDiv').addClass('hide');
                    document.write(response.responseText);
                }
            });
        }
    },

    showProposal : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/proposal/show',
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
                    //toastr["success"]('Data proposal berhasil ditampilkan','Sukses');
                    $('#viewBody').empty();
                    //fill the body
                    $('#viewBody').append('<h3><b>'+response.proposal.judul+'</b></h3><hr>');
                    $('#viewBody').append('<h4><b>Abstrak</b></h4><hr><p style="text-align: justify">'+response.proposal.abstrak+'</p>');
                    $('#viewBody').append('<h4><b>Deskripsi</b></h4><hr><p style="text-align: justify">'+response.proposal.deskripsi+'</p>');
                    $('#viewBody').append('<h4><b>Keunggulan Teknologi</b></h4><hr><p style="text-align: justify">'+response.proposal.keunggulan_teknologi+'</p>');
                    $('#viewBody').append('<h4><b>Potensi Aplikasi</b></h4><hr><p style="text-align: justify">'+response.proposal.potensi_aplikasi+'</p>');
                    $('#viewBody').append('<h4><b>Tahapan Pengembangan</b></h4><hr><p style="text-align: justify">'+response.proposal.development+'</p>');
                    $('#viewBody').append('<h4><b>Kebutuhan akan proteksi HAKI</b></h4><hr>');
                    $('#viewBody').append('<table class="table table-striped table-bordered table-hover" id="tblHAKI" name="tblHAKI">' +
                        '<tbody> <tr> <td>Jenis Patent</td> <td>'+response.proposal.haki[0]+'</td> </tr><tr> <td>Nomor Patent</td> <td>'+response.proposal.haki[1]
                        +'</td> </tr></tbody></table>');
                    $('#viewBody').append('<h4><b>Kata kunci teknologi</b></h4><hr>');
                    var kunciTeknologi = '<table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3"> <thead> <tr>' +
                        ' <th>No</th> <th>Level 1</th> <th>Level 2</th> <th>Level 3</th> </tr> </thead> <tbody>';
                    var num = response.proposal.kataKunciTeknologi.length;
                    index = 1;
                    for(var i=0;i<num;i++){
                        kunciTeknologi += '<tr> <td>'+index+'</td> <td>'+response.proposal.kataKunciTeknologi[i][0]+'</td> <td>'+response.proposal.kataKunciTeknologi[i][1]
                            +'</td> <td>'+response.proposal.kataKunciTeknologi[i][2]+'</td> </tr>';
                            index++;
                    }
                    kunciTeknologi += '</tbody></table>';
                    $('#viewBody').append(kunciTeknologi);
                    /*$('#viewBody').append('<h4><b>Kata kunci Aplikasi</b></h4><hr>');
                    var kunciAplikasi = '<table class="table table-striped table-bordered table-hover" id="tblAplikasiLevel3" name="tblAplikasiLevel3"> <thead> <tr>' +
                        ' <th>No</th> <th>Level 1</th> <th>Level 2</th> <th>Level 3</th> </tr> </thead> <tbody>';
                    var num = response.proposal.kataKunciAplikasi.length;
                    index = 1;
                    for(var i=0;i<num;i++){
                        kunciAplikasi += '<tr> <td>'+index+'</td> <td>'+response.proposal.kataKunciAplikasi[i][0]+'</td> <td>'+response.proposal.kataKunciAplikasi[i][1]
                            +'</td> <td>'+response.proposal.kataKunciAplikasi[i][2]+'</td> </tr>';
                        index++;
                    }
                    kunciAplikasi += '</tbody></table>';*/
                    $('#viewBody').append('<h4><b>Kata kunci Aplikasi</b></h4><hr>');
                    var kunciAplikasi = '<table class="table table-striped table-bordered table-hover" id="tblAplikasiLevel3" name="tblAplikasiLevel3"> <thead> <tr>' +
                        ' <th>No</th> <th>Level 1</th> <th>Level 2</th> <th>Level 3</th> </tr> </thead> <tbody>';
                    var num = response.proposal.kataKunciAplikasi.length;
                    index = 1;
                    for(var i=0;i<num;i++){
                        kunciAplikasi += '<tr> <td>'+index+'</td> <td>'+response.proposal.kataKunciAplikasi[i][0]+'</td> <td>'+response.proposal.kataKunciAplikasi[i][1]
                            +'</td> <td>'+response.proposal.kataKunciAplikasi[i][2]+'</td> </tr>';
                        index++;
                    }
                    kunciAplikasi += '</tbody></table>';
                    $('#viewBody').append(kunciAplikasi);
                    $('#popupViewProposal').modal();
                }else if (response.status == "exist"){
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    proposal.config.valid = false;
                    toastr["info"]('Proposal '+$('#selProposal option:selected').text()+' sudah ditambahkan kedalam topik '+$('#selTopik option:selected').text(),'Info');
                }
            },
            error: function (response) {
                //alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                //$('#loadingDiv').removeClass('show');
                //$('#loadingDiv').addClass('hide');
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
        proposal.init();
    });
    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var json = '{"sender":"bic","id_topik":'+$('#selTopik').val()+',"id_proposal":'+$('#selProposal').val()+'}';
    proposal.saveProposal(json);
});

$('#btnBatal').on('click',function(){
    proposal.redirectToPage(host+'/admin/adminproses/proposal');
});

$('#selBatch').on('change',function(){
    var json = '{"sender":"bic","id":'+$('#selBatch').val()+'}';
    proposal.loadTopik(json);
});

$('#selProposal').on('change',function(){
    if ($('#selProposal').val() == '0'){
        $('#btnView').prop('disabled',true);
    }else{
        $('#btnView').prop('disabled',false);
    }
});

$('#btnView').on('click',function(){
    if ($('#selProposal').val() == '0'){
        toastr['error']('Pilih Proposal terlebih dahulu','Error');
    }else{
        var json = '{"sender":"bic","id":'+$('#selProposal').val()+'}';
        proposal.showProposal(json);
    }
    //$('#popupViewProposal').modal();
});