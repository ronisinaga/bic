/**
 * Created by alienware on 1/4/2018.
 */

var edituser = {
    config: {
        valid: false
    },
    init: function(settings){
        $.extend(edituser.config,settings);
        edituser.setup();
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
                if (edituser.config.valid){
                    //location.href = host+'/admin/usergroup';
                    edituser.redirectToPage(host+'/admin/users');
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

        $("#selJK").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },

    validateEmail: function(email){
        if (email == ''){
            toastr['error']('Email tidak boleh kosong','Error');
            return false;
        }else{
            //cek apakah email sudah dalam format email
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var valid = re.test(email.toLowerCase());
            if (!valid){
                toastr['error']('Input tidak dalam format email. Pastikan input dalam format email','Error');
                return false;
            }else{
                return true;
            }
        }
    },

    valid: function(){
        if (!edituser.validateEmail($('#email').val())){
            edituser.config.valid = false;
            return false;
        }else if($('#fullname').val() == ''){
            toastr['error']('Nama pengguna tidak boleh kosong','Error');
            edituser.config.valid = false;
            return false;
        }else if($('#selJK').val() == ''){
            toastr['error']('Jenis kelamin pengguna harus dipilih','Error');
            edituser.config.valid = false;
            return false;
        }else if ($('#hp').val() == ''){
            toastr['error']('Nomor HP tidak boleh kosong','Error');
            edituser.config.valid = false;
            return false;
        }else{
            edituser.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (edituser.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/users/'+$('#id').val()+'/edit',
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
                    }else if (response.status == 'exist'){
                        edituser.config.valid = false;
                        toastr['error']("Email sudah ada didalam basisdata. gunakan alamat email lain atau update data email yang sudah ada","Success");
                    }
                },
                error: function (response) {
                    //toastr['error'](response.responseText,"Error");
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
        edituser.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnUpdate').on('click',function(){
    var json ='';
    if ($("#email").val() == $('#hiddenEmail').val()){
        json= '{"sender":"bic_new","id":"'+$("#id").val()+'","email":"","fullname":"'+$("#fullname").val()+'","jk":"'+$("#selJK").val()+'","hp":"'+$("#hp").val()+'","alamat":"'+$("#alamat").val()+'","alasan":"","kategori":"'+$("#selKategori").val()+'"}';
    }else{
        json= '{"sender":"bic_new","id":"'+$("#id").val()+'","email":"'+$("#email").val()+'","fullname":"'+$("#fullname").val()+'","jk":"'+$("#selJK").val()+'","hp":"'+$("#hp").val()+'","alamat":"'+$("#alamat").val()+'","alasan":"","kategori":"'+$("#selKategori").val()+'"}';
    }
    edituser.save(json);
});

$('#btnBatal').on('click',function(){
    edituser.redirectToPage(host+'/admin/users');
});