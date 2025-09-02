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
    updateProposal : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/proposal/update',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status=="success"){
                    toastr["success"]('Sukses update status proposal','Sukses');

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
        var rows = $('#tblPemenang tr').length;
        var selStatus = '<select id="selStatus" name="selStatus" class="form-control">';
        selStatus += '<option value="0">--Pilih Status--</option>';
        var len = statusProposal.length;
        for(var j=0;j<len;j++){
            if (listProposal[0].status == parseInt(statusProposal[j][0])){
                selStatus += '<option value="'+statusProposal[j][0]+'" selected>'+statusProposal[j][1]+'</option>';

            }else{
                selStatus += '<option value="'+statusProposal[j][0]+'">'+statusProposal[j][1]+'</option>';
            }
        }
        selStatus += "</select>";
        if (listProposal[0].average != "0"){
            $('#tblPemenang tbody:last').append("<tr><td>"+rows+"</td>" +
                "<td><p style='color: #000000'>"+listProposal[0].id+"</td>" +
                "<td><p style='color: #000000'>"+listProposal[0].alasan+"</td>" +
                "<td><p style='color: #000000'>"+listProposal[0].average+"</p></td>" +
                "<td>"+selStatus+"</td>" +
                "</tr>");
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
                        $('#tblPemenang tbody >tr').empty();
                        if (Array.isArray){
                            if (Array.isArray(response.listProposal[0])){
                                var num = response.listProposal.length;
                                if (num == 1){
                                    juri.makeRows(response.listProposal[0]);
                                }else{
                                    for(var i=0;i<num;i++){
                                        juri.makeRows(response.listProposal[i]);
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

$('#btnView').on('click',function(){
    var json = '{"sender":"bic","id_batch":'+$('#selBatch').val()+',"id_topik":0,"sorting":"descending"}';
    juri.showPenilaian(json);
});

$('#btnSimpan').on('click',function(){
    var result = [];
    $('#tblPemenang tbody tr').each(function(){
        var td = $(this).find('td');
        var status = $(td).find('#selStatus');
        if ($(status).val() != "0"){
            var innerResult = [$(td[1]).text(),$(status).val()];
            result.push(innerResult);
        }
    });
    var arr = {
        "sender":"bic",
        "result":result
    };
    var json = JSON.stringify(arr);
    juri.updateProposal(json);
});