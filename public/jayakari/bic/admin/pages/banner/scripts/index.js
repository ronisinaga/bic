/**
 * Created by alienware on 1/4/2018.
 */

var banner = {
    config: {
        valid:false,
        data:null
    },
    init: function(settings){
        $.extend(banner.config,settings);
        banner.setup();
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
                if (banner.config.valid){
                    banner.redirectToPage(host+'/admin/banner');
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
        banner.config.data = new FormData();
    },
    validasi: function(){
        banner.config.valid = true;
        if ($('#gambar').get(0).files.length == 0){
            toastr['error']('Gambar untuk banner harus ada','Error');
            banner.config.valid = false;
        }
        return banner.config.valid;
    },
    uploadGambar: function(){
        if (banner.validasi()){
            var nonFile = {
                'sender':'bic',
                'keterangan':$('#keterangan').val()
            };
            var json = JSON.stringify(nonFile);
            banner.config.data.append('data_non_file',json);
            $.ajax({
                method: 'POST',
                url: host+'/admin/banner/gambar',
                data: banner.config.data,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == "success"){
                        banner.config.valid = true;
                        toastr["success"]('Berhasil upload banner','Success');
                    }else{
                        banner.config.valid = false;
                        toastr["error"]('Gagal upload banner','Error');
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
        $.ajax({
            method: 'POST',
            url: host+'/admin/banner/removeFile',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    banner.config.valid = true;
                    toastr['success']("Sistem berhasil hapus banner","Success");
                }else{
                    banner.config.valid = false;
                    toastr['success']("Sistem gagal hapus banner. Hubungi administrator anda","Error");
                }
            },
            error: function (response) {
                banner.config.valid = false;
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
        banner.init();
        $('.btn-outline').magnificPopup({type:'image'});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnBatal').on('click',function(){
    banner.redirectToPage(host+'/admin/news/newsgroup');
});

$('#gambar').on('change',function(event){
    var files = event.target.files[0];
    if (files.size > 10485760){
        banner.config.kirim = false;
        toastr["error"]('Ukuran file banner banner terlalu besar. Maksimum ukuran file adalah 10 MB','Error');
        $(this).val('');
    }else{
        allowable = true;
        switch (files.type){
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
            banner.config.data.delete('gambar');
            banner.config.data.append('gambar',files);
        }else{
            banner.config.kirim = false;
            toastr["error"]("Tipe banner tidak dikenali. Tipe file yang dikenali adalah image (png,jpg,jpeg,gif dan bmp)","Error");
            $(this).val('');
        }
    }
});

$('form').on('submit',function(event){
    event.stopPropagation();
    event.preventDefault();
    banner.uploadGambar();
});

$('.remove').on('click',function(){
    var json = '{"sender":"bic","id":'+$(this).attr('value')+'}';
    banner.removeFile(json);
});

$('.edit').on('click',function(){
    banner.redirectToPage(host+'/admin/banner/'+$(this).attr('value')+'/edit');
});