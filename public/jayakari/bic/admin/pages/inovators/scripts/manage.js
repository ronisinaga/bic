/**
 * Created by alienware on 1/4/2018.
 */

var manage = {
    config: {
        table: null,
        valid: false
    },
    init: function(settings){
        $.extend(manage.config,settings);
        manage.setup();
    },
    setup: function(){


    },

    valid: function(){
        valid = true;
        if ($('#title').val() == ''){
            toastr['error'](judul);
            valid = false;
        }
        if (CKEDITOR.instances['highlight'].getData() == ''){
            toastr['error'](highlight);
            valid = false;
        }
        if (CKEDITOR.instances['abstrak'].getData() == ''){
            toastr['error'](abstrak);
            valid = false;
        }
        if (CKEDITOR.instances['deskripsi'].getData() == ''){
            toastr['error'](deskripsi);
            valid = false;
        }
        if (CKEDITOR.instances['teknologi'].getData() == ''){
            toastr['error'](keunggulan_teknologi);
            valid = false;
        }
        if (CKEDITOR.instances['aplikasi'].getData() == ''){
            toastr['error'](potensi_aplikasi);
            valid = false;
        }
        return valid;
    },
    save: function(json){
        if (manage.valid()){
            $.ajax({
                method: 'POST',
                url: host+'/admin/inovator/proposal/explanation/manage/save',
                data: {
                    data: json
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        toastr['success']("Sistem berhasil simpan data penjelasan proposal","Success");
                        manage.redirectToPage(host+'/admin/inovator/proposal/explanation/manage');
                    }
                },
                error: function (response) {
                    alert(response.responseText);
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
        manage.init();
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#new').on('click',function(){
    manage.redirectToPage(host+'/admin/inovator/proposal/explanation/manage/add');
});

$('#selProposalType').on('change',function(){
    var explanation = JSON.parse($('#explanation').val());
    var num = explanation.length;
    found = false;
    for(var i=0;i<num&&!found;i++){
        if ($(this).val() == explanation[i].proposal_type){
            found = true;
            $('#title').val(explanation[i].judul);
            CKEDITOR.instances['highlight'].setData(explanation[i].highlight,{
                callback: function() {
                    this.checkDirty(); // true
                }
            });
            CKEDITOR.instances['abstrak'].setData(explanation[i].abstrak,{
                callback: function() {
                    this.checkDirty(); // true
                }
            });
            CKEDITOR.instances['deskripsi'].setData(explanation[i].deskripsi,{
                callback: function() {
                    this.checkDirty(); // true
                }
            });
            CKEDITOR.instances.teknologi.setData(explanation[i].keunggulan_teknologi,{
                callback: function() {
                    this.checkDirty(); // true
                }
            });
            CKEDITOR.instances.aplikasi.setData(explanation[i].potensi_aplikasi,{
                callback: function() {
                    this.checkDirty(); // true
                }
            });
        }
    }
    if ($(this).val() == "0"){
        $('#divData').css('display','none');
    }else{
        $('#divData').css('display','block');
    }
});

$('#save').on('click',function(){
    var arr ={
        'title':$('#title').val(),
        'proposal_type':$('#selProposalType').val(),
        'highlight':CKEDITOR.instances['highlight'].getData(),
        'abstrak':CKEDITOR.instances['abstrak'].getData(),
        'deskripsi':CKEDITOR.instances['deskripsi'].getData(),
        'keunggulan_teknologi':CKEDITOR.instances['teknologi'].getData(),
        'potensi_aplikasi':CKEDITOR.instances['aplikasi'].getData()
    };
    var json = JSON.stringify(arr);
    manage.config.kirim = true;
    manage.save(json);
});

