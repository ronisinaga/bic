/**
 * Created by alienware on 1/4/2018.
 */

var editusergroup = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(editusergroup.config,settings);
        editusergroup.setup();
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
                if (editusergroup.config.valid){
                    //location.href = host+'/admin/usergroup';
                    editusergroup.redirectToPage(host+'/admin/usergroup');
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
        var selected = [];
        $('#checkboxes input:checked').each(function() {
            selected.push($(this).attr('name'));
        });
        if ($('#kategori').val() == ''){
            toastr['error']('Nama kategori pengguna harus diisi','Error');
            editusergroup.config.valid = false;
            return false;
        }else if (selected.length == 0){
            editusergroup.config.valid = false;
            toastr['error']('Hak Akses belum dipilih','Error');
            return false;
        }else{
            editusergroup.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (editusergroup.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/usergroup/'+$('#id').val()+'/edit',
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
        editusergroup.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var hak_akses = [];
    $('#checkboxes input:checked').each(function() {
        hak_akses.push($(this).attr('value'));
    });
    var num = hak_akses.length;
    var str_hak_akses = '';
    for(var i=0;i<num;i++){
        if (i == num-1){
            str_hak_akses += hak_akses[i];
        }else{
            str_hak_akses += hak_akses[i]+',';
        }
    }
    var json = '{"sender":"bic_new","id":"'+$('#id').val()+'","kategori":"'+$('#kategori').val()+'","hak_akses":['+str_hak_akses+'],"keterangan":"'+$('#keterangan').val()+'"}';
    //alert(json);
    editusergroup.save(json)
});

$('#btnBatal').on('click',function(){
    editusergroup.redirectToPage(host+'/admin/users/usergroup');
});