/**
 * Created by alienware on 1/4/2018.
 */

var videos = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(videos.config,settings);
        videos.setup();
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
                if (videos.config.valid){
                    videos.redirectToPage(host+'/admin/videos');
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

        $("#selBagianBuku").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        $("#selBuku").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        $("#selIsiBuku").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },

    valid: function(){
        videos.config.valid = true;
        if ($('#url').val() == ''){
            toastr['error']('URL Youtube harus diisi','Error');
            videos.config.valid = false;
        }if ($('#keterangan').val() == ''){
            toastr['error']('Keterangan Video harus diisi','Error');
            videos.config.valid = false;
        }
        return videos.config.valid;
    },

    save: function(json){
        if (videos.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/videos/create',
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
                    }else{
                        videos.config.valid = false;
                        toastr['success']("Sistem gagal menyimpan data video. Hubungi administrator anda","Error");
                    }
                },
                error: function (response) {
                    videos.config.valid = false;
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
        videos.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //videos.redirectToPage(host+'/admin/videos');
    var arr = {
        "sender":"bic",
        "url_youtube":$("#url").val(),
        "keterangan":$("#keterangan").val()
    }
    var json= JSON.stringify(arr);
    videos.save(json);
});

$('#btnBatal').on('click',function(){
    videos.redirectToPage(host+'/admin/videos');
});