/**
 * Created by alienware on 1/4/2018.
 */

var berita = {
    config: {
        valid:false,
        editor:null,
        data:null
    },
    init: function(settings){
        $.extend(berita.config,settings);
        berita.setup();
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
                if (berita.config.valid){
                    berita.redirectToPage(host+'/admin/berita');
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
        berita.config.editor = CKEDITOR.replace('isi');
        berita.config.data = new FormData();
    },
    validasi: function(){
        berita.config.valid = true;
        if ($('#judul').val() == ''){
            toastr['error']('Judul berita harus diisi','Error');
            berita.config.valid = false;
        }if (berita.config.editor.getData() == ''){
            toastr['error']('Isi berita harus diisi','Error');
            berita.config.valid = false;
        }if ($('#gambar').get(0).files.length == 0){
            toastr['error']('Gambar untuk berita harus ada','Error');
            berita.config.valid = false;
        }
        return berita.config.valid;
    },
    saveBerita: function(){
        if (berita.validasi()){
            var nonFile = {
                'sender':'bic',
                'tanggal':$('#tanggal').val(),
                'judul':$('#judul').val(),
                'keterangan':$('#keterangan').val(),
                'isi':berita.config.editor.getData()
            };
            var json = JSON.stringify(nonFile);
            berita.config.data.append('data_non_file',json);
            $.ajax({
                method: 'POST',
                url: host+'/admin/berita/create',
                data: berita.config.data,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == "success"){
                        berita.config.valid = true;
                        toastr["success"]('Berhasil upload berita','Success');
                    }else{
                        berita.config.valid = false;
                        toastr["error"]('Gagal upload berita','Error');
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
        berita.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnBatal').on('click',function(){
    berita.redirectToPage(host+'/admin/news/newsgroup');
});

$('#gambar').on('change',function(event){
    var files = event.target.files[0];
    if (files.size > 10485760){
        berita.config.kirim = false;
        toastr["error"]('Ukuran file gambar berita terlalu besar. Maksimum ukuran file adalah 10 MB','Error');
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
            berita.config.data.delete('gambar');
            berita.config.data.append('gambar',files);
        }else{
            berita.config.kirim = false;
            toastr["error"]("Tipe gambar tidak dikenali. Tipe gambar yang dikenali untuk cover berita adalah image (png,jpg,jpeg,gif dan bmp)","Error");
            $(this).val('');
        }
    }
});

$('form').on('submit',function(event){
    event.stopPropagation();
    event.preventDefault();
    berita.saveBerita();
});