/**
 * Created by alienware on 1/4/2018.
 */

var addmenugroup = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(addmenugroup.config,settings);
        addmenugroup.setup();
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
                if (addmenugroup.config.valid){
                    location.href = host+'/admin/menugroup';
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

        $.get(host+'/public/storage/icon/icons.yml', function(data) {
             var parsedYaml = jsyaml.load(data);
             var icons = parsedYaml.icons;
             var max = icons.length;
             $.each(parsedYaml.icons, function (index, icon) {
                 $('#selIcon').append($('<option class="fa"></option>').val("fa fa-"+icon.id).html('&#x'+icon.unicode+'; ' + icon.name));
                 //$('#selIcon').append('<option value="fa fa-' + icon.id + '"> &#x' + icon.unicode + " " + icon.name + '</option>');
             });

            $("#selIcon").chosen({
                enable_split_word_search: true,
                search_contains: true
            });
        });

    },

    valid: function(){
        if ($('#kategori').val() == ''){
            toastr['error']('Nama kategori harus diisi','Error');
            addmenugroup.config.valid = false;
            return false;
        }else if ($('#selIcon').val() == ''){
            addmenugroup.config.valid = false;
            toastr['error']('Icon kategori harus dipilih','Error');
            return false;
        }else{
            addmenugroup.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (addmenugroup.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/menugroup/create',
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
        addmenugroup.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //addmenugroup.redirectToPage(host+'/admin/menugroup');
    var json= '{"sender":"bic_new","kategori":"'+$("#kategori").val()+'","icon":"'+$("#selIcon").val()+'","url":"'+$("#url").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    addmenugroup.save(json);
});

$('#btnBatal').on('click',function(){
    addmenugroup.redirectToPage(host+'/admin/menugroup');
});