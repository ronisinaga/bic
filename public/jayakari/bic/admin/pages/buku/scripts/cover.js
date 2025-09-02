/**
 * Created by alienware on 1/4/2018.
 */

var buku = {
    config: {
        valid:false,
        data:null
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

        buku.config.data = new FormData();

    },

    valid: function(){
        buku.config.valid = true;
        if ($('#folder').val() == ''){
            toastr['error'](folder);
            buku.config.valid = false;
        }
        return buku.config.valid;
    },
    uploadFile: function(){
        if (buku.valid()){
            var nonFile = {
                'sender':'bic',
                'id':$('#id').val()
            };
            var json = JSON.stringify(nonFile);
            buku.config.data.append('data_non_file',json);
            $.ajax({
                method: 'POST',
                url: save,
                data: buku.config.data,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == "success"){
                        buku.config.valid = true;
                        toastr["success"]('Berhasil upload file.-'+response.path,'Success');
                    }else{
                        buku.config.valid = false;
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

$('#gambar').on('change',function(event){
    var files = event.target.files[0];
    if (files.size > 10485760){
        buku.config.kirim = false;
        toastr["error"]('Ukuran file gambar buku terlalu besar. Maksimum ukuran file adalah 10 MB','Error');
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
            buku.config.data.delete('gambar');
            buku.config.data.append('gambar',files);
        }else{
            buku.config.kirim = false;
            toastr["error"]("Tipe file tidak dikenali. Tipe file yang dikenali adalah image (png,jpg,jpeg,gif dan bmp)","Error");
            $(this).val('');
        }
    }
});

$('form').on('submit',function(event){
    event.stopPropagation();
    event.preventDefault();
    buku.uploadFile();
});

$('#btnBatal').on('click',function(){
    buku.redirectToPage(back);
});