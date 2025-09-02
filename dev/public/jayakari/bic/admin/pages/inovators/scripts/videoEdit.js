/**
 * Created by alienware on 1/4/2018.
 */

var arn = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(arn.config,settings);
        arn.setup();
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
                if (arn.config.valid){
                    arn.redirectToPage(back);
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

    },

    valid: function(){
        arn.config.valid = true;
        if ($('#description').val() == ''){
            toastr['error']('Deskripsi video proposal harus diisi','Error');
            arn.config.valid = false;
        }
        if ($('#video').val() == ''){
            toastr['error']('Video youtube id harus diisi','Error');
            arn.config.valid = false;
        }
        return arn.config.valid;
    },

    save: function(json){
        if (arn.valid()){
            $.ajax({
                method: 'POST',
                url: save,
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
                    //document.write(response.responseText);
                    toastr['error'](response.responseText,"Error");
                }
            });
        }
    },

    removeData: function(json){
        $.ajax({
            method: 'POST',
            url: remove,
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    arn.config.valid = true;
                    toastr['success']("Sistem berhasil hapus data perkembangan proposal","Success");
                }else{
                    arn.config.valid = false;
                    toastr['success']("Sistem gagal hapus data perkembangan proposal. Hubungi administrator anda","Error");
                }
            },
            error: function (response) {
                arn.config.valid = false;
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
        arn.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //arn.redirectToPage(host+'/admin/arn');
    var arr = {
        'sender':'BIC',
        'id':$('#id').val(),
        'id_proposal':$('#id_proposal').val(),
        'video':$('#video').val(),
        'deskripsi':$('#description').val()
    };
    var json= JSON.stringify(arr);
    arn.save(json);
});

$('#btnBatal').on('click',function(){
    arn.redirectToPage(mainback);
});

$('#tblResult').on('click','#hapus',function(){
    var json = '{"sender":"BIC","id":'+$(this).attr('value')+'}';
    arn.removeData(json);
});