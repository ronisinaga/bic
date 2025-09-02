/**
 * Created by alienware on 1/4/2018.
 */

var blog = {
    config: {
        valid:false,
        editor:null,
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
                    blog.redirectToPage(host+'/admin/blog');
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
        blog.config.editor = CKEDITOR.replace('isi');
        blog.config.data = new FormData();
    },
    validasi: function(){
        blog.config.valid = true;
        if ($('#judul').val() == ''){
            toastr['error']('Judul blog harus diisi','Error');
            blog.config.valid = false;
        }if (blog.config.editor.getData() == ''){
            toastr['error']('Isi blog harus diisi','Error');
            blog.config.valid = false;
        }if ($('#gambar').get(0).files.length == 0){
            toastr['error']('Gambar untuk blog harus ada','Error');
            blog.config.valid = false;
        }
        return blog.config.valid;
    },
    saveBerita: function(){
        if (blog.validasi()){
            var nonFile = {
                'sender':'bic',
                'tanggal':$('#tanggal').val(),
                'judul':$('#judul').val(),
                'keterangan':$('#keterangan').val(),
                'isi':blog.config.editor.getData()
            };
            var json = JSON.stringify(nonFile);
            blog.config.data.append('data_non_file',json);
            $.ajax({
                method: 'POST',
                url: host+'/admin/blog/create',
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
                        toastr["success"]('Berhasil upload blog','Success');
                    }else{
                        blog.config.valid = false;
                        toastr["error"]('Gagal upload blog','Error');
                    }
                },
                error: function (response) {
                    //alert(response.responseText);
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
        blog.init();
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
            case 'image/jpeg':
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
    blog.saveBerita();
});