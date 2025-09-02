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
                    buku.redirectToPage(back);
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

    valid: function(){
        buku.config.valid = true;
        if ($('#youtube').val() == ''){
            toastr['error']('URL Youtube Harus diisi','Error');
            buku.config.valid = false;
        }
        return buku.config.valid;
    },

    save: function(json){
        if (buku.valid()){
            $.ajax({
                method: 'POST',
                url: save,
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil menambahkan data kedalam database","Success");
                    }
                },
                error: function (response) {
                    document.write(response.responseText);
                    //toastr['error'](response.responseText,"Error");
                }
            });
        }
    },
    deleteData: function(json){
        $.ajax({
            method: 'POST',
            url: deleteData,
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    buku.config.valid = true;
                    toastr['success']("Sistem berhasil menghapus data dari database","Success");
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
        buku.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //buku.redirectToPage(host+'/admin/buku');
    var arr = {
        "sender":"bic",
        "id":$("#id").val(),
        "youtube":$("#youtube").val(),
        "keterangan":$("#keterangan").val()
    };
    var json= JSON.stringify(arr);
    buku.save(json);
});

$('#btnBatal').on('click',function(){
    buku.redirectToPage(host+'/admin/buku');
});

$('#tblResult').on('click','#hapus',function(){
    tr = $(this).closest('tr');
    cols = tr.find('td');
    var json = '{"sender":"bic","id":'+$(cols[1]).text()+'}';
    buku.deleteData(json);
});