/**
 * Created by alienware on 1/4/2018.
 */

var buku = {
    config: {
        valid: false,
        deskripsi:null,
        description:null,
        perspektif:null,
        keunggulanInovasi:null,
        potensiAplikasi:null
    },
    init: function(settings){
        $.extend(buku.config,settings);
        buku.setup();
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
                if (buku.config.valid){
                    buku.redirectToPage(back);
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
        $("#selStatusPaten").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
        $("#selKesiapanInovasi").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
        $("#selKerjasamaBisnis").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
        $("#selPeringkatInovasi").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
        $("#selARN").chosen({
            enable_split_word_search: true,
            search_contains: true
        });

        buku.config.deskripsi = CKEDITOR.replace("deskripsi");
        buku.config.description = CKEDITOR.replace("description");
        buku.config.perspektif = CKEDITOR.replace("perspektif");
        buku.config.potensiAplikasi = CKEDITOR.replace("potensi_aplikasi");
        buku.config.keunggulanInovasi = CKEDITOR.replace("keunggulan_inovasi");
    },

    valid: function(){
        buku.config.valid = true;
        if ($('#selARN').val() == '0'){
            toastr['error']('Pilih Agenda Riset Nasional yang sesuai','Error');
            buku.config.valid = false;
        }if ($('#selIRC').val() == null){
            toastr['error']('Kategori Teknologi harus dipilih (minimal 1)','Error');
            buku.config.valid = false;
        }if ($('#selAplikasi').val() == null){
            toastr['error']('Kategori Aplikasi harus dipilih (minimal 1)','Error');
            buku.config.valid = false;
        }if ($('#judul_singkat').val() == ''){
            toastr['error']('Judul singkat harus diisi','Error');
            buku.config.valid = false;
        }if ($('#short_title').val() == ''){
            toastr['error']('Short Title harus diisi','Error');
            buku.config.valid = false;
        }if ($('#judul_teknis_lengkap').val() == ''){
            toastr['error']('Judul Teknis Lengkap harus diisi','Error');
            buku.config.valid = false;
        }if (buku.config.deskripsi.getData() == ''){
            toastr['error']('Deskripsi singkat harus diisi','Error');
            buku.config.valid = false;
        }if (buku.config.description.getData() == ''){
            toastr['error']('Short Description harus diisi','Error');
            buku.config.valid = false;
        }if (buku.config.perspektif.getData() == ''){
            toastr['error']('Perspektif harus diisi','Error');
            buku.config.valid = false;
        }if (buku.config.keunggulanInovasi.getData() == ''){
            toastr['error']('Keunggulan Inovasi harus diisi','Error');
            buku.config.valid = false;
        }if (buku.config.potensiAplikasi.getData() == ''){
            toastr['error']('Potensi Aplikasi harus diisi','Error');
            buku.config.valid = false;
        }if ($('#inovator').val() == ''){
            toastr['error']('Inovator harus diisi','Error');
            buku.config.valid = false;
        }if ($('#institusi').val() == ''){
            toastr['error']('Institusi harus diisi','Error');
            buku.config.valid = false;
        }if ($('#alamat').val() == ''){
            toastr['error']('Alamat harus diisi','Error');
            buku.config.valid = false;
        }if ($('#selStatusPaten').val() == '0'){
            toastr['error']('Status Paten harus dipilih','Error');
            buku.config.valid = false;
        }if ($('#selKesiapanInovasi').val() == '0'){
            toastr['error']('Kesiapan Inovasi harus dipilih','Error');
            buku.config.valid = false;
        }if ($('#selKerjasamaBisnis').val() == '0'){
            toastr['error']('Kerjasama Sama harus dipilih','Error');
            buku.config.valid = false;
        }if ($('#selPeringkatInovasi').val() == '0'){
            toastr['error']('Peringkat Inovasi harus dipilih','Error');
            buku.config.valid = false;
        }
        return buku.config.valid;
    },

    save: function(json){
        if (buku.valid()){
            $.ajax({
                method: 'POST',
                url: update,
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil update data isi buku","Success");
                    }else{
                        //alert(response.message);
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
        buku.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });

    $(window).load(function(){
        $('body').backDetect(function(){
            alert("Look forward to the future, not the past!");
        });
    });
}

$('#btnSimpan').on('click',function(){
    var arr={
        "sender":"bic",
        "id":$('#id').val(),
        "id_buku":$('#id_buku').val(),
        "id_proposal":$('#id_proposal').val(),
        "arn":$('#selARN').val(),
        "teknologi":$('#selIRC').val(),
        "aplikasi":$('#selAplikasi').val(),
        "judul_singkat":$('#judul_singkat').val(),
        "short_title":$('#short_title').val(),
        "judul_teknis_lengkap":$('#judul_teknis_lengkap').val(),
        "deskripsi":buku.config.deskripsi.getData(),
        "description":buku.config.description.getData(),
        "perspektif":buku.config.perspektif.getData(),
        "keunggulan_inovasi":buku.config.keunggulanInovasi.getData(),
        "potensi_aplikasi":buku.config.potensiAplikasi.getData(),
        "inovator":$('#inovator').val(),
        "institusi":$('#institusi').val(),
        "alamat":$('#alamat').val(),
        "paten":$('#selStatusPaten').val(),
        "kesiapan_inovasi":$('#selKesiapanInovasi').val(),
        "kerjasama_bisnis":$('#selKerjasamaBisnis').val(),
        "peringkat_inovasi":$('#selPeringkatInovasi').val()
    };

    var json = JSON.stringify(arr);
    //alert(json);
    buku.save(json);
});

$('#btnBatal').on('click',function(){
    $('#popupConfirm').modal();
    //buku.redirectToPage(back);
});

$('#btnSimpan').on('click',function(){
    var arr={
        "sender":"bic",
        "id":$('#id').val(),
        "id_buku":$('#id_buku').val(),
        "id_proposal":$('#id_proposal').val(),
        "arn":$('#selARN').val(),
        "teknologi":$('#selIRC').val(),
        "aplikasi":$('#selAplikasi').val(),
        "judul_singkat":$('#judul_singkat').val(),
        "short_title":$('#short_title').val(),
        "judul_teknis_lengkap":$('#judul_teknis_lengkap').val(),
        "deskripsi":buku.config.deskripsi.getData(),
        "description":buku.config.description.getData(),
        "perspektif":buku.config.perspektif.getData(),
        "keunggulan_inovasi":buku.config.keunggulanInovasi.getData(),
        "potensi_aplikasi":buku.config.potensiAplikasi.getData(),
        "inovator":$('#inovator').val(),
        "institusi":$('#institusi').val(),
        "alamat":$('#alamat').val(),
        "paten":$('#selStatusPaten').val(),
        "kesiapan_inovasi":$('#selKesiapanInovasi').val(),
        "kerjasama_bisnis":$('#selKerjasamaBisnis').val(),
        "peringkat_inovasi":$('#selPeringkatInovasi').val()
    };

    var json = JSON.stringify(arr);
    buku.save(json);
});

$('#noupdate').on('click',function(){
    buku.redirectToPage(back);
});

(function (global) {

    if(typeof (global) === "undefined")
    {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice....
        // 50 milliseconds for just once do not cost much (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    // Earlier we had setInerval here....
    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {

        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };

    };

})(window);