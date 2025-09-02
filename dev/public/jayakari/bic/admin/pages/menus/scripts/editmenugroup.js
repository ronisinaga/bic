/**
 * Created by alienware on 1/4/2018.
 */

var editmenugroup = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(editmenugroup.config,settings);
        editmenugroup.setup();
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
                if (editmenugroup.config.valid){
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
                if (selectedicon == 'fa fa-'+icon.id){
                    //$('#selIcon').append($('<option class="fa" selected></option>').val("fa fa"+icon.id).html('&#x'+icon.unicode+'; ' + icon.name));
                    $('#selIcon').append('<option value="fa fa-' + icon.id + '" selected> &#x' + icon.unicode + " " + icon.name + '</option>');
                }else{
                    //$('#selIcon').append('<option value="fa fa-' + icon.id + '"> &#x' + icon.unicode + " " + icon.name + '</option>');
                    $('#selIcon').append($('<option class="fa"></option>').val("fa fa-"+icon.id).html('&#x'+icon.unicode+'; ' + icon.name));
                }
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
            editmenugroup.config.valid = false;
            return false;
        }else if ($('#selIcon').val() == ''){
            editmenugroup.config.valid = false;
            toastr['error']('Icon kategori harus dipilih','Error');
            return false;
        }else{
            editmenugroup.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (editmenugroup.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/menugroup/'+$('#id').val()+'/edit',
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
                        toastr['success']("Sistem berhasil update data kedalam database","Success");
                    }
                },
                error: function (response) {
                    //alert(response.responseText);
                    toastr['error'](response.responseText,"Error");
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
        editmenugroup.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnEdit').on('click',function(){
    //editmenugroup.redirectToPage('/school/admin/menugroup');
    var json= '{"sender":"school","id":"'+$('#id').val()+'","kategori":"'+$("#kategori").val()+'","url":"'+$("#url").val()+'","icon":"'+$("#selIcon").val()+'","url":"'+$("#url").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    editmenugroup.save(json);
});

$('#btnBatal').on('click',function(){
    editmenugroup.redirectToPage('/school/admin/menugroup');
});