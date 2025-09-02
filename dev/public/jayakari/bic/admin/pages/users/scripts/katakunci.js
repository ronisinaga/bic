/**
 * Created by alienware on 1/4/2018.
 */

var katakunci = {
    config: {
        valid: false
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
                    //location.href = host+'/admin/usergroup';
                    katakunci.redirectToPage(host+'/admin/adminproses/juri');
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

    save: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/juri/katakunci',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    katakunci.config.valid = true;
                    toastr['success']("Kategori dewan juri berhasil ditambahkan kedalam database","Success");
                }else{
                    katakunci.config.valid = false;
                    toastr['error']("Kategori juri gagal ditambahkan kedalam basisdata. Hubungi administrator anda","Error");
                }
            },
            error: function (response) {
                //toastr['error'](response.responseText,"Error");
                document.write(response.responseText);
            }
        });
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

$('#btnSimpan').on('click',function(){
    var kategori = [];
    $('#tblKategori tbody > tr').each(function(i,row) {
        $row = $(row);
        $cols = $row.find('td');
        kategori.push($($cols[1]).text());
    });
    var arr = {
        "sender":"bic",
        "id":$('#id').val(),
        "kategori":kategori
    };
    var json= JSON.stringify(arr);
    katakunci.save(json);
});

$('#btnBatal').on('click',function(){
    katakunci.redirectToPage(host+'/admin/users');
});
$('#tambah').on('click',function(){
    var kategori = $('#selKategori').val();
    if (kategori == '0'){
        toastr["error"]('Pilih salah satu kategori Penjurian','Error');
    }else{
        var length = $('#tblKategori tr').length;
        $("#tblKategori tbody:last").append('<tr><td>'+length+'</td><td style="display: none">'+$('#selKategori').val()+'</td><td>'+$("#selKategori option:selected").text()+'</td><td><button type="button" class="btn red" id="removeKategori" name="removeKategori"><i class="fa fa-remove"></i> Hapus</button></td>');
    }
    $('#kataKunci').css('display','block');
});

$('#tblKategori').on('click','#removeKategori',function(){
    $(this).closest('tr').remove();
});
