/**
 * Created by alienware on 1/4/2018.
 */

var juri = {
    config: {
        valid: false
    },
    init: function(settings){
        $.extend(juri.config,settings);
        juri.setup();
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
                if (juri.config.valid){
                    juri.redirectToPage(host+'/admin/adminproses/juri');
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
        juri.config.valid = true;
        if ($('#selBatch').val() == "0"){
            juri.config.valid = false;
            toastr["error"]("Batch harus dipilih","Error");
        }
        if ($('#selSorting').val() == ""){
            juri.config.valid = false;
            toastr["error"]("Jenis sorting harus dipilih","Error");
        }
        return juri.config.valid;
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
                //alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                document.write(response.responseText);
            }
        });
    },
    loadProposal : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/findProposal',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                var len = response.length;
                $('#selProposal').empty().append("<option value='0'>-- Pilih Proposal --</option>");
                if (len != 0){
                    for(var i=0;i<len;i++){
                        $('#selProposal').append("<option value='"+response[i].id+"'> "+response[i].judul+"</options>");
                    }

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
    },
    makeRows : function(listProposal){
        var num = listProposal.length;
        for(var i=0;i<num;i++){
            if (i == 0){
                var styleD1 = "color:#ffffff;font-size:14px";
                var styleD2 = "color:#ffffff;font-size:14px";
                var styleD3 = "color:#ffffff;font-size:14px";
                var styleD4 = "color:#ffffff;font-size:14px";
                var styleD5 = "color:#ffffff;font-size:14px";
                var styleD6 = "color:#ffffff;font-size:14px";
                var styleD7 = "color:#ffffff;font-size:14px";
                var styleD8 = "color:#ffffff;font-size:14px";
                var styleD9 = "color:#ffffff;font-size:14px";
                var styleG = "color:#ffffff;font-size:14px";
                if ((listProposal[i].selisih_D1 >=2) && (listProposal[i].selisih_D1 < 3)){
                    styleD1 = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].selisih_D1 >=3) && (listProposal[i].selisih_D1 < 4)){
                    styleD1 = "color:#ff0000;font-size:26px";
                }
                if ((listProposal[i].selisih_D2 >=2) && (listProposal[i].selisih_D2 < 3)){
                    styleD2 = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].selisih_D2 >=3) && (listProposal[i].selisih_D2 < 4)){
                    styleD2 = "color:#ff0000;font-size:26px";
                }
                if ((listProposal[i].selisih_D3 >=2) && (listProposal[i].selisih_D3 < 3)){
                    styleD3 = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].selisih_D3 >=3) && (listProposal[i].selisih_D3 < 4)){
                    styleD3 = "color:#ff0000;font-size:26px";
                }
                if ((listProposal[i].selisih_D4 >=2) && (listProposal[i].selisih_D4 < 3)){
                    styleD4 = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].selisih_D4 >=3) && (listProposal[i].selisih_D4 < 4)){
                    styleD4 = "color:#ff0000;font-size:26px";
                }
                if ((listProposal[i].selisih_D5 >=2) && (listProposal[i].selisih_D5 < 3)){
                    styleD5 = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].selisih_D5 >=3) && (listProposal[i].selisih_D5 < 4)){
                    styleD5 = "color:#ff0000;font-size:26px";
                }if ((listProposal[i].selisih_D6 >=2) && (listProposal[i].selisih_D6 < 3)){
                    styleD6 = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].selisih_D6 >=3) && (listProposal[i].selisih_D6 < 4)){
                    styleD6 = "color:#ff0000;font-size:26px";
                }
                if ((listProposal[i].selisih_D7 >=2) && (listProposal[i].selisih_D7 < 3)){
                    styleD7 = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].selisih_D7 >=3) && (listProposal[i].selisih_D2 < 4)){
                    styleD7 = "color:#ff0000;font-size:26px";
                }
                if ((listProposal[i].selisih_D8 >=2) && (listProposal[i].selisih_D8 < 3)){
                    styleD8 = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].selisih_D8 >=3) && (listProposal[i].selisih_D8 < 4)){
                    styleD8 = "color:#ff0000;font-size:26px";
                }
                if (listProposal[i].min_9 == 'A'){
                    styleD9 = "color:#ff0000;font-size:30px";
                }

                if ((listProposal[i].G >=2) && (listProposal[i].G < 3)){
                    styleG = "color:#ff0000;font-size:22px";
                }else if ((listProposal[i].G >=3) && (listProposal[i].G < 4)){
                    styleG = "color:#ff0000;font-size:26px";
                }
                else if ((listProposal[i].G >=4) && (listProposal[i].G < 5)){
                    styleG = "color:#ff0000;font-size:28px";
                }
                else if ((listProposal[i].G >=5) && (listProposal[i].G < 6)){
                    styleG = "color:#ff0000;font-size:30px";
                }
                else if ((listProposal[i].G >=6) && (listProposal[i].G < 7)){
                    styleG = "color:#ff0000;font-size:32px";
                }
                else if ((listProposal[i].G >=7) && (listProposal[i].G < 8)){
                    styleG = "color:#ff0000;font-size:34px";
                }else if (listProposal[i].G >=8){
                    styleG = "color:#ff0000;font-size:36px";
                }
                var average = "";
                if (listProposal[i].average != "0"){
                    average = listProposal[i].average;
                }
                if (parseInt(listProposal[i].juri) < 2){
                    $('#tblPenjurian tbody:last').append("<tr style='background-color: #5b2c6f'>" +
                        "<td width='100px'><p style='color: #ffffff'>"+listProposal[i].batch+"</p></td>" +
                        "<td width='100px'><p style='color: #ffffff'>"+listProposal[i].topik+"</p></td>" +
                        "<td><div class='row'><div class='col-md-6'><p style='color: #ffffff'>"+average+"</p></div><div class='col-md-6'><p style='color: #ffffff'>"+listProposal[i].global_urutan+" ("+listProposal[i].topik_urutan+")</p></div></div></td>" +
                        "<td><p style='color: #ff0000;font-size: 30px;'>"+listProposal[i].juri+"</p></td>" +
                        "<td><p style='"+styleD1+"'>"+listProposal[i].selisih_D1+"</p></td>" +
                        "<td><p style='"+styleD2+"'>"+listProposal[i].selisih_D2+"</p></td>" +
                        "<td><p style='"+styleD3+"'>"+listProposal[i].selisih_D3+"</p></td>" +
                        "<td><p style='"+styleD4+"'>"+listProposal[i].selisih_D4+"</p></td>" +
                        "<td><p style='"+styleD5+"'>"+listProposal[i].selisih_D5+"</p></td>" +
                        "<td><p style='"+styleD6+"'>"+listProposal[i].selisih_D6+"</td>" +
                        "<td><p style='"+styleD7+"'>"+listProposal[i].selisih_D7+"</td>" +
                        "<td><p style='"+styleD8+"'>"+listProposal[i].selisih_D8+"</td>" +
                        "<td><p style='"+styleG+"'>"+listProposal[i].G+"</td>" +
                        "<td><p style='"+styleD9+"'>"+listProposal[i].min_9+"</td>" +
                        "<td><p style='color: #ffffff'>"+listProposal[i].max_9+"</td>" +
                        "<td width='200px'><p style='color: #ffffff'>"+listProposal[i].alasan+"</td>" +
                        "</tr>");
                }else{
                    $('#tblPenjurian tbody:last').append("<tr style='background-color: #0a6aa1'>" +
                        "<td width='100px'><p style='color: #ffffff'>"+listProposal[i].batch+"</p></td>" +
                        "<td width='100px'><p style='color: #ffffff'>"+listProposal[i].topik+"</p></td>" +
                        "<td><div class='row'><div class='col-md-6'><p style='color: #ffffff'>"+average+"</p></div><div class='col-md-6'><p style='color: #ffffff'>"+listProposal[i].global_urutan+" ("+listProposal[i].topik_urutan+")</p></div></div></td>" +
                        "<td><p style='color: #ffffff'>"+listProposal[i].juri+"</p></td>" +
                        "<td><p style='"+styleD1+"'>"+listProposal[i].selisih_D1+"</p></td>" +
                        "<td><p style='"+styleD2+"'>"+listProposal[i].selisih_D2+"</p></td>" +
                        "<td><p style='"+styleD3+"'>"+listProposal[i].selisih_D3+"</p></td>" +
                        "<td><p style='"+styleD4+"'>"+listProposal[i].selisih_D4+"</p></td>" +
                        "<td><p style='"+styleD5+"'>"+listProposal[i].selisih_D5+"</p></td>" +
                        "<td><p style='"+styleD6+"'>"+listProposal[i].selisih_D6+"</td>" +
                        "<td><p style='"+styleD7+"'>"+listProposal[i].selisih_D7+"</td>" +
                        "<td><p style='"+styleD8+"'>"+listProposal[i].selisih_D8+"</td>" +
                        "<td><p style='"+styleG+"'>"+listProposal[i].G+"</td>" +
                        "<td><p style='"+styleD9+"'>"+listProposal[i].min_9+"</td>" +
                        "<td><p style='color: #ffffff'>"+listProposal[i].max_9+"</td>" +
                        "<td width='200px'><p style='color: #ffffff'>"+listProposal[i].alasan+"</td>" +
                        "</tr>");
                }
            }else{
                var average = "";
                if (listProposal[i].average != "0"){
                    average = listProposal[i].average;
                }
                $('#tblPenjurian tbody:last').append("<tr>" +
                    "<td></td>" +
                    "<td></td>" +
                    "<td>"+average+"</td>" +
                    "<td>"+listProposal[i].juri+"</td>" +
                    "<td style='background-color: #cccccc'>"+listProposal[i].selisih_D1+"</td>" +
                    "<td style='background-color: #66ccff'>"+listProposal[i].selisih_D2+"</td>" +
                    "<td style='background-color: #ffcc33'>"+listProposal[i].selisih_D3+"</td>" +
                    "<td style='background-color: #ffcc33'>"+listProposal[i].selisih_D4+"</td>" +
                    "<td style='background-color: #99ff66'>"+listProposal[i].selisih_D5+"</td>" +
                    "<td style='background-color: #99ff66'>"+listProposal[i].selisih_D6+"</td>" +
                    "<td style='background-color: #ff99ff'>"+listProposal[i].selisih_D7+"</td>" +
                    "<td style='background-color: #ff99ff'>"+listProposal[i].selisih_D8+"</td>" +
                    "<td>"+listProposal[i].G+"</td>" +
                    "<td colspan='2'>"+listProposal[i].min_9+"</td>" +
                    "<td>"+listProposal[i].alasan+"</td>" +
                    "</tr>");
            }
        }
    },

    showPenilaian : function(json){
        if (juri.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/adminproses/juri/penilaian',
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
                        juri.config.valid = false;
                        //alert('data:'+response.listProposal.length);
                        $('#tblPenjurian tbody >tr').empty();
                        if (Array.isArray){
                            if (Array.isArray(response.listProposal[0])){
                                var num = response.listProposal.length;
                                if (num == 1){
                                    juri.makeRows(response.listProposal[0]);
                                }else{
                                    for(var i=0;i<num;i++){
                                        juri.makeRows(response.listProposal[i]);
                                        if(i != num-1){
                                            $('#tblPenjurian tbody:last').append("<tr>" +
                                                "<th>Batch</th>" +
                                                "<th>Topik</th>" +
                                                "<th>Average</th>" +
                                                "<th>Juri</th>" +
                                                "<th>D1</th>" +
                                                "<th>D2</th>" +
                                                "<th>D3</th>" +
                                                "<th>D4</th>" +
                                                "<th>D5</th>" +
                                                "<th>D6</th>" +
                                                "<th>D7</th>" +
                                                "<th>D8</th>" +
                                                "<th>G</th>" +
                                                "<th>Min 9</th>" +
                                                "<th>Max 9</th>" +
                                                "<th>Judul</th>" +
                                                "</tr>");
                                        }
                                    }
                                }
                            }else{
                                juri.makeRows(response.listProposal);
                            }
                        }else{
                            if (response.listProposal[0] instanceof Array){
                                var num = response.listProposal.length;
                                if (num == 1){
                                    juri.makeRows(response.listProposal[0]);
                                }else{
                                    for(var i=0;i<num;i++){
                                        juri.makeRows(response.listProposal[i]);
                                        if(i != num-1){
                                            $('#tblPenjurian tbody:last').append("<tr>" +
                                                "<th>Batch</th>" +
                                                "<th>Topik</th>" +
                                                "<th>Average</th>" +
                                                "<th>Juri</th>" +
                                                "<th>D1</th>" +
                                                "<th>D2</th>" +
                                                "<th>D3</th>" +
                                                "<th>D4</th>" +
                                                "<th>D5</th>" +
                                                "<th>D6</th>" +
                                                "<th>D7</th>" +
                                                "<th>D8</th>" +
                                                "<th>G</th>" +
                                                "<th>Min 9</th>" +
                                                "<th>Max 9</th>" +
                                                "<th>Judul</th>" +
                                                "</tr>");
                                        }
                                    }
                                }
                            }else{
                                juri.makeRows(response.listProposal);
                            }
                        }
                        toastr["success"]('Menampilkan data','Sukses');

                    }else if (response.status == "exist"){
                        //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                        juri.config.valid = false;
                        toastr["info"]('Juri '+$('#selJuri option:selected').text()+' sudah ditambahkan kedalam topik '+$('#selTopik option:selected').text()+' dan proposal '+$('#selProposal option:selected').text(),'Info');
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
        juri.init();
    });
    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var json = '{"sender":"bic","id_batch":'+$('#selBatch').val()+',"id_topik":'+$('#selTopik').val()+',"id_proposal":'+$('#selProposal').val()+',"sorting":"'+$('#selSorting').val()+'"}';
    juri.showPenilaian(json);
});

$('#btnBatal').on('click',function(){
    juri.redirectToPage(host+'/admin/adminproses/juri');
});

$('#selBatch').on('change',function(){
    var json = '{"sender":"bic","id":'+$('#selBatch').val()+'}';
    juri.loadTopik(json);
});

$('#selTopik').on('change',function(){
    var json = '{"sender":"bic","id":'+$('#selTopik').val()+'}';
    juri.loadProposal(json);
});