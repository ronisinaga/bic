/**
 * Created by alienware on 1/4/2018.
 */

var videoinnovator = {
    config: {
        valid:false,
        editor:null,
        data:null
    },
    init: function(settings){
        $.extend(videoinnovator.config,settings);
        videoinnovator.setup();
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
                if (videoinnovator.config.valid){
                    videoinnovator.redirectToPage(host+'/admin/inovator/video');
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

        $("#selInnovator").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        videoinnovator.config.editor = CKEDITOR.replace('keterangan');
        videoinnovator.config.data = new FormData();

    },

    valid: function(){
        videoinnovator.config.valid = true;
        if ($('#selInnovator').val() == '0'){
            toastr['error']('Nama Inovator harus dipilih','Error');
            videoinnovator.config.valid = false;
        }
        if ($('#title').val() == ''){
            toastr['error']('Judul Proposal harus diisi','Error');
            videoinnovator.config.valid = false;
        }
        if ($('#url').val() == ''){
            toastr['error']('Alamat Youtube URL harus diisi','Error');
            videoinnovator.config.valid = false;
        }
        if (videoinnovator.config.editor.getData() == ''){
            toastr['error']('Keterangan video harus diisi','Error');
            videoinnovator.config.valid = false;
        }
        return videoinnovator.config.valid;
    },

    save: function(json){
        if (videoinnovator.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/inovator/video/update',
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
        videoinnovator.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //videoinnovator.redirectToPage(host+'/admin/videoinnovator');
    //JSON.stringify()
    var arr = {
        "sender":"bic",
        "id":$('#id').val(),
        "id_innovator":$('#selInnovator').val(),
        "title":$('#title').val(),
        "url":$('#url').val(),
        'keterangan':videoinnovator.config.editor.getData()
    };
    var json = JSON.stringify(arr);
    //var json= '{"sender":"bic","id":"'+$('#id').val()+'","id_innovator":"'+$('#selInnovator').val()+'","title":"'+$('#title').val()+'","url":"'+$('#url').val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    videoinnovator.save(json);
});

$('#btnBatal').on('click',function(){
    videoinnovator.redirectToPage(host+'/admin/inovator/video');
});