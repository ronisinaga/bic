/**
 * Created by alienware on 1/4/2018.
 */

var testimonial = {
    config: {
        valid:false,
        data:null,
        editor:null
    },
    init: function(settings){
        $.extend(testimonial.config,settings);
        testimonial.setup();
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
                if (testimonial.config.valid){
                    testimonial.redirectToPage(host+'/admin/testimonial');
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
        testimonial.config.data = new FormData();
        testimonial.config.editor = CKEDITOR.replace('testimonial');

    },

    valid: function(){
        testimonial.config.valid = true;
        if ($('#name').val() == ''){
            toastr['error']('Nama tidak boleh kosong','Error');
            testimonial.config.valid = false;
        }if ($('#pekerjaan').val() == ''){
            toastr['error']('Pekerjaan tidak boleh kosong','Error');
            testimonial.config.valid = false;
        }
        if (testimonial.config.editor.getData() == ""){
            toastr['error']('Testimonial tidak boleh kosong','Error');
            testimonial.config.valid = false;
        }
        return testimonial.config.valid;
    },
    uploadGambar: function(){
        if (testimonial.valid()){
            var nonFile = {
                "sender":"bic",
                "id":$('#id').val(),
                "is_active":$('#selAktif').val(),
                "testimonial":testimonial.config.editor.getData(),
                "name":$("#name").val(),
                "pekerjaan":$("#pekerjaan").val()
            };
            var json = JSON.stringify(nonFile);
            testimonial.config.data.append('data_non_file',json);
            $.ajax({
                method: 'POST',
                url: host+'/admin/testimonial/edit',
                data: testimonial.config.data,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == "success"){
                        testimonial.config.valid = true;
                        toastr["success"]('Berhasil update testimonial','Success');
                    }else{
                        testimonial.config.valid = false;
                        toastr["error"]('Gagal update testimonial','Error');
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
        testimonial.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#gambar').on('change',function(event){
    var files = event.target.files[0];
    if (files.size > 10485760){
        testimonial.config.kirim = false;
        toastr["error"]('Ukuran file testimonial testimonial terlalu besar. Maksimum ukuran file adalah 10 MB','Error');
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
            testimonial.config.data.delete('gambar');
            testimonial.config.data.append('gambar',files);
        }else{
            testimonial.config.kirim = false;
            toastr["error"]("Tipe gambar tidak dikenali. Tipe file yang dikenali adalah image (png,jpg,jpeg,gif dan bmp)","Error");
            $(this).val('');
        }
    }
});

$('form').on('submit',function(event){
    event.stopPropagation();
    event.preventDefault();
    testimonial.uploadGambar();
});

$('#btnBatal').on('click',function(){
    testimonial.redirectToPage(host+'/admin/testimonial');
});