/**
 * Created by alienware on 1/4/2018.
 */

var sendEmail = {
    config: {
        kirim : false
    },
    init: function(settings){
        $.extend(sendEmail.config,settings);
        sendEmail.setup();
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
                if (sendEmail.config.kirim){
                    sendEmail.redirectToPage(host+'/admin/reviewer/proposal/revisi');
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

        $("#selStatus").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },
    valid: function(){
        sendEmail.config.kirim = true;
        if (CKEDITOR.instances['sendEmail'].getData() == ''){
            sendEmail.config.kirim = false;
            toastr["error"]('Anda belum menuliskan pesan ke inovator. Silahkan isi pesan anda kepada inovator','Error');
        }
        return sendEmail.config.kirim;
    },
    saveReview : function(json){
        if (sendEmail.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/reviewer/proposal/sendEmail',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == "success"){
                        sendEmail.config.kirim = true;
                        toastr["success"]('Berhasil simpan pesan reminder yang berkaitan dengan proposal inovasi','Success');
                    }
                },
                error: function (response) {
                    alert(response.responseText);
                    //toastr['error'](response.responseText,"Error");
                    //document.write(response.responseText);
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
        sendEmail.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnsendEmail').on('click',function(){
    var arr = {
        "sender":"bic",
        "id_proposal":$('#id').val(),
        "isi":CKEDITOR.instances['sendEmail'].getData()
    };
    var json = JSON.stringify(arr);
    sendEmail.saveReview(json);
});

$('#tblHistory').on('click','#detailMessage',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var isi = $($cols[5]).html();
    $('#isi').empty();
    $('#isi').append('<label class="control-label"><b>Isi Review</b></label><div class="keterangan"><table class="table table-striped table-bordered table-hover"><tbody><tr><td>'+isi+'</td></tr></tbody></table></div>');
});