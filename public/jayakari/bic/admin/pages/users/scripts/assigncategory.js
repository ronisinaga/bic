/**
 * Created by alienware on 1/4/2018.
 */

var assigncategory = {
    config: {
        valid:false
    },
    init: function(settings){
        $.extend(assigncategory.config,settings);
        assigncategory.setup();
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
                if (assigncategory.config.valid){
                    //location.href = host+'/admin/usergroup';
                    assigncategory.redirectToPage(host+'/admin/userassign');
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
    },

    valid: function(){
        if ($('#kategori tr').length == 0){
            toastr['error']('Pengguna minimal harus diassign ke satu kategori pengguna','Error');
            assigncategory.config.valid = false;
            return false;
        }else{
            assigncategory.config.valid = true;
            return true;
        }
    },

    save: function(json){
        if (assigncategory.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/userassign/'+$('#id').val()+'/edit',
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
        assigncategory.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    var json = '{"sender":"bic","id_user":'+$('#id').val()+',"kategori":[';
    var len = $('#kategori tbody > tr').length;
    $('#kategori tbody > tr').each(function(i,row){
        $row = $(row);
        $cols = $row.find('td');
        if (i == len-1){
            json += $($cols[1]).text()+']';
        }else{
            json += $($cols[1]).text()+',';
        }
        //alert($($cols[2]).text());
        /*$row.find('td').each(function(j,column){
            $column = $(column);
            alert($column.text());
        });*/
    });
    json += '}';
    assigncategory.save(json)
});

$('#btnBatal').on('click',function(){
    assigncategory.redirectToPage(host+'/admin/users/usergroup');
});

$('#kategori').on('click','#remove',function(){
   $(this).closest('tr').remove();
    //$(this).parents('tr').first().remove();
});

$('#add').on('click',function(){
    var kategori = $('#selKategori').val();
    if (kategori == '0'){
        toastr["error"]('Kategori pengguna harus dipilih terlebih dahulu','Error');
    }else{
        var length = $('#kategori tr').length;
        $("#kategori tbody:last").append('<tr><td>'+length+'</td><td style="display: none">'+$('#selKategori').val()+'</td><td>'+$("#selKategori option:selected").text()+'</td><td><button type="button" class="btn red" id="remove" name="remove"><i class="fa fa-remove"></i> Hapus</button></td>');
    }
});