/**
 * Created by alienware on 1/4/2018.
 */

var lengkapiproposal = {
    config: {
        review: $('#reviewProposal'),
        reviewAtas: $('#reviewProposalAtas'),
        kirim : false
    },
    init: function(settings){
        $.extend(lengkapiproposal.config,settings);
        lengkapiproposal.setup();
    },
    setup: function(){
        var isFilled = filled == '1';
        if (isFilled){
            lengkapiproposal.config.review.attr({enabled:'enabled'});
            lengkapiproposal.config.reviewAtas.attr({enabled:'enabled'});
        }else{
            lengkapiproposal.config.review.attr({disabled:'disabled'});
            lengkapiproposal.config.reviewAtas.attr({disabled:'disabled'});
        }

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "onHidden": function() {
                if (lengkapiproposal.config.kirim){
                    $('#popupBatal').modal('hide');
                    lengkapiproposal.redirectToPage(host+'/admin/inovator/proposal');
                }
                //
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
    batalProposal : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/proposal/batal',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    lengkapiproposal.config.kirim = true;
                    toastr["success"]('Proses pembatalan proposal berhasil dilakukan','Success');
                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    lengkapiproposal.config.kirim = false;
                    toastr["error"]('Proses pembatalan proposal gagal dilakukan. Hubungi administrator anda','Error');
                }
            },
            error: function (response) {
                lengkapiproposal.config.kirim = false;
                //alert(response.responseText);
                //toastr["error"]('Gagal mengirimkan pesan ke reviewer. Hubungi administrator anda','Error');
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
        lengkapiproposal.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#reviewProposal').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/message/'+$('#id').val()+'/askreview');
});

$('#batalProposal').on('click',function(){
    $('#popupBatal').modal();
});

$('#popupBatalProposal').on('click',function(){
    var json = '{"sender":"json","id_proposal":'+$('#popupProposalID').val()+'}';
    lengkapiproposal.batalProposal(json);
});

$('#batal').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/proposal');
});

$('#reviewProposalAtas').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/message/'+$('#id').val()+'/askreview');
});

$('#batalProposalAtas').on('click',function(){
    $('#popupBatal').modal();
});

$('#batalAtas').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/proposal');
});

$('#batal').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/proposal');
});

$('#explanationAtas').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/proposal/explanation');
});

$('#explanation').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/proposal/explanation');
});

$('#reviewProposalAtas').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/message/'+$('#id').val()+'/askreview');
});

$('#batalProposalAtas').on('click',function(){
    $('#popupBatal').modal();
});

$('#batalAtas').on('click',function(){
    lengkapiproposal.redirectToPage(host+'/admin/inovator/proposal');
});

$('#tblHistory').on('click','#detailMessage',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var isi = $($cols[5]).text();
    $('#isi').empty();
    $('#isi').append('<label class="control-label"><b>Isi Review</b></label><div class="keterangan"><table class="table table-striped table-bordered table-hover"><tbody><tr><td>'+isi+'</td></tr></tbody></table></div>');
});