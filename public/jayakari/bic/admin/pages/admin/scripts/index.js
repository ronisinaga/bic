/**
 * Created by alienware on 1/4/2018.
 */

var index = {
    config: {
        row : null
    },
    init: function(settings){
        $.extend(index.config,settings);
        index.setup();
    },
    setup: function(){
        $("#selFolder").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },

    find: function(json){
        $.ajax({
            method: 'POST',
            url: find,
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    if(response.result.length > 0){
                        $('#error').removeClass('alert alert-success').addClass('alert alert-danger').css('display','block').html('File-file yang terinfeksi malware ditemukan');
                        num = response.result.length;
                        $('#tblInfected tbody').empty();
                        for(var i=0;i<num;i++){
                            var length = $('#tblInfected tr').length;
                            $("#tblInfected tbody:last").append('<tr><td>'+length+'</td><td>'+response.result[i].folder+'</td><td>'+response.result[i].file+'</td><td>'+response.result[i].status+'</td><td><button type="button" class="btn btn-danger" id="delete" name="delete"><i class="ti ti-trash"></i> Hapus </button></td></tr>');
                        }

                    }else{
                        $('#error').removeClass('alert alert-danger').addClass('alert alert-success').css('display','block').html('Tidak ada file yang terinfeksi malware');
                    }
                    //toastr['success']("Sistem berhasil menambahkan data kedalam database","Success");
                }
            },
            error: function (response) {
                document.write(response.responseText);
                //toastr['error'](response.responseText,"Error");
            }
        });
    },

    delete: function(json){
        $.ajax({
            method: 'POST',
            url: deletes,
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    $('#error').removeClass('alert alert-danger').addClass('alert alert-success').css('display','block').html('File behasil dihapus');
                    index.config.row.remove();
                }
            },
            error: function (response) {
                document.write(response.responseText);
                //toastr['error'](response.responseText,"Error");
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

jQuery(document).ready(function() {
    index.init();
});

$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
    ajaxStop: function() { $body.removeClass("loading"); }
});

$('#new').on('click',function(){
    var arr = {
        'sender':'BIC',
        'folder':$('#selFolder').val()
    };
    var json = JSON.stringify(arr);

    index.find(json);
});

$('#tblInfected').on('click','#delete',function(){
    var row = $(this).closest('tr');
    cols = row.find('td');
    folder = $(cols[1]).text();
    file = $(cols[2]).text();
    var arr = {
        'folder':folder,
        'file':file
    }
    var json = JSON.stringify(arr);
    index.delete(json);
    index.config.row = row;
});