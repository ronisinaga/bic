/**
 * Created by alienware on 1/4/2018.
 */

var judul = {
    config: {
        valid:false,
        lanjut:false,
        id_proposal:0
    },
    init: function(settings){
        $.extend(judul.config,settings);
        judul.setup();
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
                if (judul.config.valid){
                    if (judul.config.lanjut){
                        judul.redirectToPage(host+'/admin/inovator/proposal/'+judul.config.id_proposal+'/lengkapi');
                    }else{
                        judul.redirectToPage(host+'/admin/inovator/proposal');
                    }
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
        if ($('#judul').val() == ''){
            toastr['error']('Judul Inovasi harus diisi','Error');
            judul.config.valid = false;
            return false;
        }else{
            judul.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (judul.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/inovator/proposal/create',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    //$('#loadingDiv').removeClass('hide');
                    //$('#loadingDiv').addClass('show');
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    //$('#loadingDiv').removeClass('show');
                    //$('#loadingDiv').addClass('hide');
                    if (response.status == 'success'){
                        //alert('berhasil menambahkan data kedalam database');
                        judul.config.id_proposal = response.id_proposal;
                        toastr['success']("Sistem berhasil menambahkan data kedalam database","Success");
                    }
                },
                error: function (response) {
                    alert(response.responseText);
                    //toastr['error'](response.responseText,"Error");
                    //$('#loadingDiv').removeClass('show');
                    //$('#loadingDiv').addClass('hide');
                    //document.write(response.responseText);
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
        judul.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //judul.redirectToPage(host+'/admin/menugroup');
    //var json= '{"sender":"bic","judul":"'+$("#judul").val()+'"}';
    var arr = {
        "sender":"BIC",
        "judul":$("#judul").val()
    };
    var json = JSON.stringify(arr);
    judul.config.lanjut = false;
    judul.save(json);
});

$('#btnLanjut').on('click',function(){
    //judul.redirectToPage(host+'/admin/menugroup');
    //var json= '{"sender":"bic","judul":"'+$("#judul").val()+'"}';
    var arr = {
        "sender":"BIC",
        "judul":$("#judul").val()
    };
    var json = JSON.stringify(arr);
    judul.config.lanjut = true;
    judul.save(json);
});

$('#btnBatal').on('click',function(){
    judul.redirectToPage(host+'/admin/inovator/proposal');
});