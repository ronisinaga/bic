/**
 * Created by alienware on 1/4/2018.
 */

var katakunci = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(katakunci.config,settings);
        katakunci.setup();
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
                if (katakunci.config.valid){
                    katakunci.redirectToPage(host+'/admin/katakunci');
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

        $("#selLevel").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        $("#selParent").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        $("#selType").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

    },

    valid: function(){
        if ($('#selType').val() == ''){
            toastr['error']('Tipe harus dipilih','Error');
            katakunci.config.valid = false;
            return false;
        }else if ($('#selLevel').val() == ''){
            toastr['error']('Level Kunci Teknologi harus dipilih','Error');
            katakunci.config.valid = false;
            return false;
        }else{
            katakunci.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (katakunci.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/katakunci/create',
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
        katakunci.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#selLevel').on('change',function(){
    switch($('#selLevel').val()){
        case 'Level 1':
            $('#level2').prop('disabled',true);
            $('#level3').prop('disabled',true);
            break;
        case 'Level 2':
            $('#level2').prop('disabled',false);
            $('#level3').prop('disabled',true);
            break;
        case 'Level 3':
            $('#level2').prop('disabled',false);
            $('#level3').prop('disabled',false);
            break;
    }
});

$('#btnSimpan').on('click',function(){
    //katakunci.redirectToPage(host+'/admin/katakunci');
    var level1 = "";
    var level2 = "000";
    var level3 = "000";
    switch($('#selLevel').val()){
        case 'Level 1':
            level1 = $('#level1').val();
            break;
        case 'Level 2':
            level1 = $('#level1').val();
            level2 = $('#level2').val();
            break;
        case 'Level 3':
            level1 = $('#level1').val();
            level2 = $('#level2').val();
            level3 = $('#level3').val();
            break;
    }
    var json= '{"sender":"bic","id":"'+$("#id").val()+'","type":"'+$("#selType").val()+'","level":"'+$("#selLevel").val()+'","level1":"'+level1+'","level2":"'+level2+'","level3":"'+level3+'","katakunci":"'+$("#katakunciteknologi").val()+'","parent":"'+$("#selParent").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    katakunci.save(json);
});

$('#btnBatal').on('click',function(){
    katakunci.redirectToPage(host+'/admin/katakunci');
});