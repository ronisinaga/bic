/**
 * Created by alienware on 1/4/2018.
 */

var buku = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(buku.config,settings);
        buku.setup();
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
                if (buku.config.valid){
                    buku.redirectToPage(host+'/admin/buku');
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

        $("#selBatch").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },

    valid: function(){
        buku.config.valid = true;
        if ($('#buku').val() == ''){
            toastr['error']('Nama Batch harus diisi','Error');
            buku.config.valid = false;
        }
        if ($('#tahun').val() == ""){
            toastr['error']('Tahun Batch harus diisi','Error');
            buku.config.valid = false;
        }
        return buku.config.valid;
    },

    save: function(json){
        if (buku.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/buku/'+$('#id').val()+'/edit',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil update data kedalam database","Success");
                    }
                },
                error: function (response) {
                    document.write(response.responseText);
                    //toastr['error'](response.responseText,"Error");
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
        buku.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var arr = {
        "sender":"bic",
        "id":$("#id").val(),
        "batch":$("#selBatch").val(),
        "judul":$("#judul").val(),
        "tanggal":$("#tanggal").val()
    };
    var json= JSON.stringify(arr);
    buku.save(json);
});

$('#btnBatal').on('click',function(){
    buku.redirectToPage(host+'/admin/buku');
});