/**
 * Created by alienware on 1/4/2018.
 */

var berita = {
    config: {
        valid:false,
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
                    berita.redirectToPage(host+'/admin/berita/'+$('#id').val()+'/file');
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
        berita.config.data = new FormData();
    },
    validasi: function(){
        berita.config.valid = true;
        if ($('#file').get(0).files.length == 0){
            toastr['error']('file untuk berita harus ada','Error');
            berita.config.valid = false;
        }
        return berita.config.valid;
    },
    uploadGambar: function(){
        if (berita.validasi()){
            var nonFile = {
                'sender':'bic',
                'keterangan':$('#keterangan').val(),
                'id':$('#id').val()
            };
            var json = JSON.stringify(nonFile);
            berita.config.data.append('data_non_file',json);
            $.ajax({
                method: 'POST',
                url: host+'/admin/berita/file',
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
                        toastr["success"]('Berhasil upload file','Success');
                    }else{
                        berita.config.valid = false;
                        toastr["error"]('Gagal upload file','Error');
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
            url: host+'/admin/berita/removeAttachment',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    berita.config.valid = true;
                    toastr['success']("Sistem berhasil hapus file berita","Success");
                }else{
                    berita.config.valid = false;
                    toastr['success']("Sistem gagal hapus file berita. Hubungi administrator anda","Error");
                }
            },
            error: function (response) {
                berita.config.valid = false;
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
        berita.init();
        $('.btn-outline').magnificPopup({type:'image'});
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

$('#file').on('change',function(event){
    var files = event.target.files[0];
    if (files.size > 10485760){
        berita.config.kirim = false;
        toastr["error"]('Ukuran file berita terlalu besar. Maksimum ukuran file adalah 10 MB','Error');
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
            case 'application/pdf':
                type ='pdf';
                break;
            case 'application/msword':
                type ='doc';
                break;
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                type ='docx';
                break;
            case 'application/vnd.ms-excel':
                type ='xls';
                break;
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                type ='xlsx';
                break;
            case 'application/vnd.ms-powerpoint':
                type ='ppt';
                break;
            case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                type ='pptx';
                break;
            default:
                allowable = false;
                break;
        }
        if (allowable){
            berita.config.data.delete('file');
            berita.config.data.append('file',files);
        }else{
            berita.config.kirim = false;
            toastr["error"]("Tipe file tidak dikenali. Tipe file yang dikenali untuk cover berita adalah image (png,jpg,jpeg,gif dan bmp),pdf,doc,docx,xls,xlsx,ppt,pptx","Error");
            $(this).val('');
        }
    }
});

$('form').on('submit',function(event){
    event.stopPropagation();
    event.preventDefault();
    berita.uploadGambar();
});

$('.remove').on('click',function(){
    var json = '{"sender":"navigator","id":'+$(this).attr('value')+'}';
    berita.removeFile(json);
});