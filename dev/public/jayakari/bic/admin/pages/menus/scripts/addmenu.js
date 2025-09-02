/**
 * Created by alienware on 1/4/2018.
 */

var addmenu = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(addmenu.config,settings);
        addmenu.setup();
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
                if (addmenu.config.valid){
                    location.href = host+'/admin/menus';
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

        //$.get('https://rawgit.com/FortAwesome/Font-Awesome/master/src/icons.yml', function(data) {
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

        $("#selKategori").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },

    valid: function(){
        if ($('#selKategori').val() == ''){
            toastr['error']('Kategori menu harus dipilih','Error');
            addmenu.config.valid = false;
            return false;
        }else if ($('#menu').val() == ''){
            addmenu.config.valid = false;
            toastr['error']('Nama menu harus diisi','Error');
            return false;
        }else if ($('#url').val() == ''){
            addmenu.config.valid = false;
            toastr['error']('URL menu harus dipilih','Error');
            return false;
        }else if ($('#selIcon').val() == ''){
            addmenu.config.valid = false;
            toastr['error']('Icon menu harus dipilih','Error');
            return false;
        }else{
            addmenu.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (addmenu.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/menus/create',
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
        addmenu.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //addmenu.redirectToPage(host+'/admin/menugroup');
    var json= '{"sender":"bic_new","idKategori":"'+$("#selKategori").val()+'","menu":"'+$("#menu").val()+'","icon":"'+$("#selIcon").val()+'","url":"'+$("#url").val()+'","keterangan":"'+$("#keterangan").val()+'"}';
    addmenu.save(json);
});

$('#btnBatal').on('click',function(){
    addmenu.redirectToPage(host+'/admin/menus');
});