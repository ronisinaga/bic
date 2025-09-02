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

        if ($('#selTopik').val() == "0"){
            juri.config.valid = false;
            toastr["error"]("Topik harus dipilih","Error");
        }
        if ($('#selJuri').val() == "0"){
            juri.config.valid = false;
            toastr["error"]("Juri harus dipilih","Error");
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

    saveJuri : function(json){
        if (juri.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/adminproses/juri/create',
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
                        toastr["success"]('Data assign juri berhasil ditambahkan ke dalam basisdata','Sukses');

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
    var json = '{"sender":"bic","id_topik":'+$('#selTopik').val()+',"id_juri":'+$('#selJuri').val()+'}';
    juri.saveJuri(json);
});

$('#btnBatal').on('click',function(){
    juri.redirectToPage(host+'/admin/adminproses/juri');
});

$('#selBatch').on('change',function(){
    var json = '{"sender":"bic","id":'+$('#selBatch').val()+'}';
    juri.loadTopik(json);
});