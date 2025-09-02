/**
 * Created by alienware on 1/4/2018.
 */

var blog = {
    config: {
        valid:false,
        data:null
    },
    init: function(settings){
        $.extend(blog.config,settings);
        blog.setup();
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
                if (blog.config.valid){
                    blog.redirectToPage(host+'/admin/blog/'+$('#id').val()+'/gambar');
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
        blog.config.data = new FormData();
    },
    validasi: function(){
        blog.config.valid = true;
        if ($('#gambar').get(0).files.length == 0){
            toastr['error']('Gambar untuk blog harus ada','Error');
            blog.config.valid = false;
        }
        return blog.config.valid;
    },
    uploadGambar: function(){
        if (blog.validasi()){
            var nonFile = {
                'sender':'bic',
                'keterangan':$('#keterangan').val(),
                'id':$('#id').val()
            };
            var json = JSON.stringify(nonFile);
            blog.config.data.append('data_non_file',json);
            $.ajax({
                method: 'POST',
                url: host+'/admin/blog/gambar',
                data: blog.config.data,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == "success"){
                        blog.config.valid = true;
                        toastr["success"]('Berhasil upload gambar','Success');
                    }else{
                        blog.config.valid = false;
                        toastr["error"]('Gagal upload gambar','Error');
                    }
                },
                error: function (response) {
                    //alert(response.responseText);
                    document.write(response.responseText);
                }
            });
        }
    },

    removeFile: function(json){
        $.confirm({
            title: 'Hapus Gambar',
            content: 'Apakah anda ingin menghapus gambar ini? Apabila anda hapus seluruh data yang berkaitan dengan data gambar ini akan dihapus juga',
            buttons: {
                confirm: {
                    text: "Hapus",
                    action: function () {
                        $.ajax({
                            method: 'POST',
                            url: host+'/admin/blog/removeFile',
                            data: {
                                data: json
                            },
                            dataType: "json",
                            beforeSend: function (request) {
                                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                            },
                            success: function (response){
                                if (response.status == 'success'){
                                    blog.config.valid = true;
                                    toastr['success']("Sistem berhasil hapus gambar blog","Success");
                                }else{
                                    blog.config.valid = false;
                                    toastr['success']("Sistem gagal hapus gambar blog. Hubungi administrator anda","Error");
                                }
                            },
                            error: function (response) {
                                blog.config.valid = false;
                                document.write(response.responseText);
                                //toastr['error'](response.responseText,"Error");
                            }
                        });
                    }
                },
                cancel: {
                    text: "Tidak",
                    action: function () {

                    }
                }
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        blog.init();
        $('.btn-outline').magnificPopup({type:'image'});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnBatal').on('click',function(){
    blog.redirectToPage(host+'/admin/news/newsgroup');
});

$('#gambar').on('change',function(event){
    var files = event.target.files[0];
    if (files.size > 10485760){
        blog.config.kirim = false;
        toastr["error"]('Ukuran file gambar blog terlalu besar. Maksimum ukuran file adalah 10 MB','Error');
        $(this).val('');
    }else{
        allowable = true;
        switch (files.type.toLowerCase()){
            case 'image/jpg':
                break;
            case 'image/png':
                break;
            case 'image/gif':
                break;
            case 'image/bmp':
                break;
            default:
                allowable = false;
                break;
        }
        if (allowable){
            blog.config.data.delete('gambar');
            blog.config.data.append('gambar',files);
        }else{
            blog.config.kirim = false;
            toastr["error"]("Tipe gambar tidak dikenali. Tipe gambar yang dikenali untuk cover blog adalah image (png,jpg,jpeg,gif dan bmp)","Error");
            $(this).val('');
        }
    }
});

$('form').on('submit',function(event){
    event.stopPropagation();
    event.preventDefault();
    blog.uploadGambar();
});

$('.remove').on('click',function(){
    var json = '{"sender":"navigator","id":'+$(this).attr('value')+'}';
    blog.removeFile(json);
});