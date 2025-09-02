/**
 * Created by alienware on 1/4/2018.
 */

var employee = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(employee.config,settings);
        employee.setup();
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
                if (employee.config.valid){
                    employee.redirectToPage(host+'/admin/employee');
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
        if ($('#employee').val() == ''){
            toastr['error']('Jumlah Karyawan harus diisi','Error');
            employee.config.valid = false;
            return false;
        }else{
            employee.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (employee.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/employee/create',
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
                    //document.write(response.responseText);
                    toastr['error'](response.responseText,"Error");
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
        employee.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //employee.redirectToPage(host+'/admin/employee');
    var json= '{"sender":"bic_new","employee":"'+$("#employee").val()+'","kode":"'+$("#kode").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    employee.save(json);
});

$('#btnBatal').on('click',function(){
    employee.redirectToPage(host+'/admin/employee');
});