/**
 * Created by alienware on 1/4/2018.
 */

var editmenu = {
    config: {

    },
    init: function(settings){
        $.extend(editmenu.config,settings);
        editmenu.setup();
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
                location.href = host+'/admin/menus';
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
                    $('#selIcon').append($('<option class="fa"></option>').val("fa fa-"+icon.id).html('&#x'+icon.unicode+'; ' + icon.name));
                }
            });

            $("#selIcon").chosen({
                enable_split_word_search: true,
                search_contains: true
            });
        });

        $("#selKategori").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },

    valid: function(){
        if ($('#selKategori').val() == ''){
            toastr['error']('Kategori menu harus dipilih','Error');
            editmenu.config.valid = false;
            return false;
        }else if ($('#menu').val() == ''){
            editmenu.config.valid = false;
            toastr['error']('Nama menu harus diisi','Error');
            return false;
        }else if ($('#url').val() == ''){
            editmenu.config.valid = false;
            toastr['error']('URL menu harus dipilih','Error');
            return false;
        }else if ($('#selIcon').val() == ''){
            editmenu.config.valid = false;
            toastr['error']('Icon menu harus dipilih','Error');
            return false;
        }else{
            editmenu.config.valid = true;
            return true;
        }
    },

    save: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/menus/'+$('#id').val()+'/edit',
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
                toastr['error'](response.responseText,"Error");
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        editmenu.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnEdit').on('click',function(){
    //editmenu.redirectToPage(host+'/admin/menugroup');
    var json= '{"sender":"bic","id":"'+$("#id").val()+'","idKategori":"'+$("#selKategori").val()+'","menu":"'+$("#menu").val()+'","icon":"'+$("#selIcon").val()+'","url":"'+$("#url").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    editmenu.save(json);
});

$('#btnBatal').on('click',function(){
    editmenu.redirectToPage(host+'/admin/menus');
});