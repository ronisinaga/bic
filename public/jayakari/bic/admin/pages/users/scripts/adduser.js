/**
 * Created by alienware on 1/4/2018.
 */

var adduser = {
    config: {
        valid: false
    },
    init: function(settings){
        $.extend(adduser.config,settings);
        adduser.setup();
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
                if (adduser.config.valid){
                    //location.href = host+'/admin/usergroup';
                    adduser.redirectToPage(host+'/admin/users');
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
        if (!adduser.validateEmail($('#email').val())){
            adduser.config.valid = false;
            return false;
        }else if($('#fullname').val() == ''){
            toastr['error']('Nama pengguna tidak boleh kosong','Error');
            adduser.config.valid = false;
            return false;
        }else if($('#selJK').val() == ''){
            toastr['error']('Jenis kelamin pengguna harus dipilih','Error');
            adduser.config.valid = false;
            return false;
        }else if ($('#hp').val() == ''){
            toastr['error']('Nomor HP tidak boleh kosong','Error');
            adduser.config.valid = false;
            return false;
        }else{
            adduser.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (adduser.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/users/create',
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
                    }else if (response.status == 'exist'){
                        adduser.config.valid = false;
                        toastr['error']("Username sudah ada didalam basisdata. gunakan username lain atau update data username yang sudah ada","Error");
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
        adduser.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var json= '{"sender":"bic","is_active":1,"email":"'+$("#email").val()+'","fullname":"'+$("#fullname").val()+'","jk":"'+$("#selJK").val()+'","hp":"'+$("#hp").val()+'","alamat":"'+$("#alamat").val()+'","alasan":"","kategori":"'+$("#selKategori").val()+'"}';
    adduser.save(json);
});

$('#btnBatal').on('click',function(){
    adduser.redirectToPage(host+'/admin/users');
});