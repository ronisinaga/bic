/**
 * Created by alienware on 1/4/2018.
 */

var dictionary = {
    config: {
        valid:false,
        file:null
    },
    init: function(settings){
        $.extend(dictionary.config,settings);
        dictionary.setup();
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
                if (dictionary.config.valid){
                    dictionary.redirectToPage(host+'/admin/dictionary');
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

        $("#selKategori").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },

    save: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/dictionary/'+$('#id').val()+'/edit',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                //alert(host+'/admin/dictionary/'+$('#id').val()+'/edit');
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    dictionary.config.valid = true;
                    toastr['success']("Sistem berhasil update data kedalam database","Success");
                }
            },
            error: function (response) {
                document.write(response.responseText);
                //toastr['error'](response.responseText,"Error");
            }
        });
    },

    uploadFile : function(id_kategori_dictionary,keterangan){
        var data = new FormData();
        data.append('id_kategori_dictionary',id_kategori_dictionary);
        data.append('keterangan',keterangan);
        data.append('action',"update");
        data.append('id',$('#id').val());
        for(var i=0;i<dictionary.config.file.length;i++){
            var file = dictionary.config.file[i];
            if (file.size > 1048576){
                toastr["error"]('Ukuran file terlalu besar. Maksimum ukuran file adalah 1 MB','Error');
            }else{
                var type = '';
                allowable = true;
                switch (file.type){
                    case 'image/jpg':
                        type ='image';
                        break;
                    case 'image/png':
                        type ='image';
                        break;
                    case 'image/gif':
                        type ='image';
                        break;
                    case 'image/jpeg':
                        type ='image';
                        break;
                    case 'image/bmp':
                        type ='image';
                        break;
                    default:
                        allowable = false;
                        break;
                }
                if (allowable){
                    data.append('file',file);
                    $.ajax({
                        method: 'POST',
                        url: host+'/admin/dictionary/uploadFile',
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function (response){
                            if (response.status == "success"){
                                dictionary.config.valid = true;
                                toastr["success"]('Berhasil upload file ke sistem','Success');
                            }else{
                                toastr["error"]('Gagal upload file','Error');
                            }
                        },
                        error: function (response) {
                            //alert(response.responseText);
                            document.write(response.responseText);
                            //toastr['error'](response.responseText,"Error");
                        }
                    });
                }else{
                    toastr["error"]("Tipe File tidak dikenali","Error");
                }
            }
        }
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        dictionary.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //dictionary.redirectToPage(host+'/admin/dictionary');
    var value = $("#selKategori").val().split('-');
    var json = "";
    json= '{"sender":"bic","id":"'+$('#id').val()+'","id_kategori_dictionary":"'+value[0]+'","value":"'+$("#value").val()+'","public_path":"","keterangan":"'+$("#keterangan").val()+'"}';
    //alert(json);
    dictionary.save(json);
});

$('#btnSimpanAngka').on('click',function(){
    var value = $("#selKategori").val().split('-');
    var json = "";
    if (isNaN($('#valueAngka').val())){
        dictionary.config.valid = false;
        toastr["error"]("Input harus dalam bentuk angka","Error");
    }else{
        var value = $("#selKategori").val().split('-');
        var json = "";
        json = '{"sender":"bic","id":'+$('#id').val()+',"id_kategori_dictionary":"'+value[0]+'","value":"'+$("#valueAngka").val()+'","public_path":"","keterangan":"'+$("#keteranganAngka").val()+'"}';
        dictionary.save(json);
    }
});

$('#btnSimpanLinkText').on('click',function(){
    //dictionary.redirectToPage(host+'/admin/dictionary');
    var value = $("#selKategori").val().split('-');
    var json = "";
    json = '{"sender":"bic","id":'+$('#id').val()+',"id_kategori_dictionary":"'+value[0]+'","value":"'+$("#valueURL").val()+'","public_path":"'+$("#url").val()+'","keterangan":"'+$("#keteranganLinkText").val()+'"}';
    dictionary.save(json);
});

$('#btnSimpanContent').on('click',function(){
    //dictionary.redirectToPage(host+'/admin/dictionary');
    var value = $("#selKategori").val().split('-');
    var arr = {
        "sender":"bic",
        "id":$('#id').val(),
        "id_kategori_dictionary":value[0],
        "value":CKEDITOR.instances['valueContent'].getData(),
        "keterangan":$('#keteranganContent').val(),
        "public_path":""
    }
    var json = JSON.stringify(arr);
    dictionary.save(json);
});

$('#btnSimpanImage').on('click',function(){
    var value = $("#selKategori").val().split('-');
    $('form').on('submit',function(event){
        event.stopPropagation();
        event.preventDefault();
        dictionary.uploadFile(value[0],$("#keteranganImage").val());
    });
});

$('#btnBatal').on('click',function(){
    dictionary.redirectToPage(host+'/admin/dictionary');
});

$('input[type=file]').on('change', function(event){
    dictionary.config.file = event.target.files;
});