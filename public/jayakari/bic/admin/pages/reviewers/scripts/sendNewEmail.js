/**
 * Created by alienware on 1/4/2018.
 */

var sendNewEmail = {
    config: {
        kirim : false
    },
    init: function(settings){
        $.extend(sendNewEmail.config,settings);
        sendNewEmail.setup();
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
                if (sendNewEmail.config.kirim){
                    sendNewEmail.redirectToPage(host+'/admin/reviewer/proposal/masuk');
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
        sendNewEmail.config.kirim = true;
        if ($('#selStatus').val() == '0'){
            sendNewEmail.config.kirim = false;
            toastr["error"]('Status belum dipilih. Silahkan pilih terlebih dahulu status proposal yang diinginkan','Error');
        }
        if (CKEDITOR.instances['sendNewEmail'].getData() == ''){
            sendNewEmail.config.kirim = false;
            toastr["error"]('Anda belum menuliskan pesan ke inovator. Silahkan isi pesan anda kepada inovator','Error');
        }
        return sendNewEmail.config.kirim;
    },
    saveReview : function(json){
        if (sendNewEmail.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/reviewer/proposal/sendNewEmail',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == "success"){
                        sendNewEmail.config.kirim = true;
                        toastr["success"]('Berhasil simpan pesan reminder yang berkaitan dengan proposal inovasi','Success');
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
        sendNewEmail.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnsendNewEmail').on('click',function(){
    var arr = {
        "sender":"bic",
        "id_proposal":$('#id').val(),
        "status":$('#selStatus').val(),
        "isi":CKEDITOR.instances['sendNewEmail'].getData()
    };
    var json = JSON.stringify(arr);
    sendNewEmail.saveReview(json);
});

$('#tblHistory').on('click','#detailMessage',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var isi = $($cols[5]).html();
    $('#isi').empty();
    $('#isi').append('<label class="control-label"><b>Isi Review</b></label><div class="keterangan"><table class="table table-striped table-bordered table-hover"><tbody><tr><td>'+isi+'</td></tr></tbody></table></div>');
});