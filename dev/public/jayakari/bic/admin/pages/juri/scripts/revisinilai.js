/**
 * Created by alienware on 1/4/2018.
 */

var revisinilai = {
    config: {
        valid : false
    },
    init: function(settings){
        $.extend(revisinilai.config,settings);
        revisinilai.setup();
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
                if (revisinilai.config.valid){
                    revisinilai.redirectToPage(host+'/admin/juri/proposal/sudahnilai');
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
    },
    save: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/juri/proposal/'+$('#id').val()+'/revisinilai',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    revisinilai.config.valid = true;
                    toastr['success']("Sistem berhasil update data kedalam database","Success");
                }
            },
            error: function (response) {
                document.write(response.responseText);
                //toastr['error'](response.responseText,"Error");
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        revisinilai.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#new').on('click',function(){
    revisinilai.redirectToPage(host+'/admin/revisinilai/create');
});

$('#TNO').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNO').val());
    $('#ket').css('background-color','#cccccc');

});

$('#TNRU').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNRU').val());
    $('#ket').css('background-color','#66ccff');

});

$('#TNDT').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNDT').val());
    $('#ket').css('background-color','#ffcc33');

});

$('#TNT').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNT').val());
    $('#ket').css('background-color','#ffcc33');

});

$('#TNP').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNP').val());
    $('#ket').css('background-color','#99ff66');

});

$('#TNPE').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNPE').val());
    $('#ket').css('background-color','#99ff66');

});

$('#TNPB').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNPB').val());
    $('#ket').css('background-color','#ff99ff');

});

$('#TNRB').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNRB').val());
    $('#ket').css('background-color','#ff99ff');

});

$('#TNR').on('click',function(event){
    event.stopPropagation();
    event.preventDefault();
    $('#penjelasan').empty();
    $('#penjelasan').append($('#XPNR').val());
    $('#ket').css('background-color','#ffffcc');

});

$('#btnSimpan').on('click',function(){
    //revisinilai.redirectToPage(host+'/admin/revisinilai');
    var TNO = "0";
    var TNRU = "0";
    var TNDT = "0";
    var TNT = "0";
    var TNP = "0";
    var TNPE = "0";
    var TNPB = "0";
    var TNRB = "0";
    var TNR = "0";
    if (($("input:radio[name='OTNO'][value='1']").prop("checked")) || ($("input:radio[name='OTNO'][value='2']").prop("checked")) || ($("input:radio[name='OTNO'][value='3']").prop("checked")) || ($("input:radio[name='OTNO'][value='4']").prop("checked"))){
        TNO = $("input:radio[name='OTNO']:checked").val();
    }
    if (($("input:radio[name='OTNRU'][value='1']").prop("checked")) || ($("input:radio[name='OTNRU'][value='2']").prop("checked")) || ($("input:radio[name='OTNRU'][value='3']").prop("checked")) || ($("input:radio[name='OTNRU'][value='4']").prop("checked"))){
        TNRU = $("input:radio[name='OTNRU']:checked").val();
    }
    if (($("input:radio[name='OTNDT'][value='1']").prop("checked")) || ($("input:radio[name='OTNDT'][value='2']").prop("checked")) || ($("input:radio[name='OTNDT'][value='3']").prop("checked")) || ($("input:radio[name='OTNDT'][value='4']").prop("checked"))){
        TNDT = $("input:radio[name='OTNDT']:checked").val();
    }
    if (($("input:radio[name='OTNT'][value='1']").prop("checked")) || ($("input:radio[name='OTNT'][value='2']").prop("checked")) || ($("input:radio[name='OTNT'][value='3']").prop("checked")) || ($("input:radio[name='OTNT'][value='4']").prop("checked"))){
        TNT = $("input:radio[name='OTNT']:checked").val();
    }
    if (($("input:radio[name='OTNP'][value='1']").prop("checked")) || ($("input:radio[name='OTNP'][value='2']").prop("checked")) || ($("input:radio[name='OTNP'][value='3']").prop("checked")) || ($("input:radio[name='OTNP'][value='4']").prop("checked"))){
        TNP = $("input:radio[name='OTNP']:checked").val();
    }
    if (($("input:radio[name='OTNPE'][value='1']").prop("checked")) || ($("input:radio[name='OTNPE'][value='2']").prop("checked")) || ($("input:radio[name='OTNPE'][value='3']").prop("checked")) || ($("input:radio[name='OTNPE'][value='4']").prop("checked"))){
        TNPE = $("input:radio[name='OTNPE']:checked").val();
    }
    if (($("input:radio[name='OTNPB'][value='1']").prop("checked")) || ($("input:radio[name='OTNPB'][value='2']").prop("checked")) || ($("input:radio[name='OTNPB'][value='3']").prop("checked")) || ($("input:radio[name='OTNPB'][value='4']").prop("checked"))){
        TNPB = $("input:radio[name='OTNPB']:checked").val();
    }
    if (($("input:radio[name='OTNRB'][value='1']").prop("checked")) || ($("input:radio[name='OTNRB'][value='2']").prop("checked")) || ($("input:radio[name='OTNRB'][value='3']").prop("checked")) || ($("input:radio[name='OTNRB'][value='4']").prop("checked"))){
        TNRB = $("input:radio[name='OTNRB']:checked").val();
    }
    if (($("input:radio[name='OTNR'][value='1']").prop("checked")) || ($("input:radio[name='OTNR'][value='2']").prop("checked")) || ($("input:radio[name='OTNR'][value='3']").prop("checked")) || ($("input:radio[name='OTNR'][value='4']").prop("checked"))){
        TNR = $("input:radio[name='OTNR']:checked").val();
    }
    var arr = {
        "sender":"bic",
        "id":$('#id').val(),
        "id_proposal":$('#id_proposal').val(),
        "id_topik":$('#id_topik').val(),
        "id_juri":$('#id_juri').val(),
        "id_proposal":$('#id_proposal').val(),
        "TNO":TNO,
        "TNRU":TNRU,
        "TNDT":TNDT,
        "TNT":TNT,
        "TNP":TNP,
        "TNPE":TNPE,
        "TNPB":TNPB,
        "TNRB":TNRB,
        "TNR":TNR,
        "alasan":$('#alasan').val()
    };
    /*var arr = {
        "sender":"bic",
        "id":$('#id').val(),
        "id_proposal":$('#id_proposal').val(),
        "id_topik":$('#id_topik').val(),
        "id_juri":$('#id_juri').val(),
        "id_proposal":$('#id_proposal').val(),
        "TNO":$("input:radio[name='OTNO']:checked").val(),
        "TNRU":$("input:radio[name='OTNRU']:checked").val(),
        "TNDT":$("input:radio[name='OTNDT']:checked").val(),
        "TNT":$("input:radio[name='OTNT']:checked").val(),
        "TNP":$("input:radio[name='OTNP']:checked").val(),
        "TNPE":$("input:radio[name='OTNPE']:checked").val(),
        "TNPB":$("input:radio[name='OTNPB']:checked").val(),
        "TNRB":$("input:radio[name='OTNRB']:checked").val(),
        "TNR":$("input:radio[name='OTNR']:checked").val(),
        "alasan":$('#alasan').val()
    }*/
    var json= JSON.stringify(arr);
    revisinilai.save(json);
});

$('#btnBatal').on('click',function(){
    revisinilai.redirectToPage(host+'/admin/juri/proposal/sudahnilai');
});