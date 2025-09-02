/**
 * Created by alienware on 1/4/2018.
 */

var index = {
    config: {

    },
    init: function(settings){
        $.extend(index.config,settings);
        index.setup();
    },
    setup: function(){

    },

    deactivate: function(json){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: deactivate,
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                //return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    $('#error').removeClass('alert alert-warning').addClass('alert alert-success').css('display','block').html('<strong>'+response.message+'</strong>');
                    index.redirectToPage(back)
                }else{
                    index.config.valid = false;
                    $('#error').removeClass('alert alert-success').addClass('alert alert-warning').css('display','block').html('<strong>'+response.message+'</strong>');
                }
            },
            error: function (response) {
                //alert('Errors');
                //index.config.valid = false;
                document.write(response.responseText);
                //toastr['error'](response.responseText,"Error");
            }
        });
    },

    delete: function(json){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: hapus,
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                //return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    $('#error').removeClass('alert alert-warning').addClass('alert alert-success').css('display','block').html('<strong>'+response.message+'</strong>');
                    index.redirectToPage(back)
                }else{
                    index.config.valid = false;
                    $('#error').removeClass('alert alert-success').addClass('alert alert-warning').css('display','block').html('<strong>'+response.message+'</strong>');
                }
            },
            error: function (response) {
                //alert('Errors');
                //index.config.valid = false;
                document.write(response.responseText);
                //toastr['error'](response.responseText,"Error");
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        index.init();
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#new').on('click',function(){
    index.redirectToPage(host+'/admin/berita/create');
});

$('#sample_1').on('click','#deaktivasi',function(){
    var tr = $(this).closest('tr');
    var td = $(tr).find('td');
    var arr = {
        'sender':'BIC',
        'id':$(td[1]).text(),
        'active':$(this).attr('value')
    };
    var json = JSON.stringify(arr);
    index.deactivate(json);
});

$('#sample_1').on('click','#delete',function(){
    var tr = $(this).closest('tr');
    var td = $(tr).find('td');
    $.confirm({
        title: 'Hapus Berita',
        content: 'Apakah anda ingin menghapus Berita '+$(td[2]).text()+' ini?',
        buttons: {
            confirm: {
                text: "Hapus",
                action: function () {
                    var arr = {
                        'sender':'BIC',
                        'id':$(td[1]).text()
                    };
                    var json = JSON.stringify(arr);
                    index.delete(json);
                }
            },
            cancel: {
                text: "Tidak",
                action: function () {

                }
            }
        }
    });
});