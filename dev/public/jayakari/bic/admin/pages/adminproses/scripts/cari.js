/**
 * Created by alienware on 1/4/2018.
 */

var cari = {
    config: {
        kirim : false,
        table : null
    },
    init: function(settings){
        $.extend(cari.config,settings);
        cari.setup();
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
                if (cari.config.kirim){
                    //cari.redirectToPage(host+'/admin/adminproses/proposal/sudahcari');
                }
            },
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $("#selStatus").chosen({
            enable_split_word_search: true,
            search_contains: true
        });
    },
    cariProposal : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/reviewer/proposal/cariProposal',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    if ($.fn.DataTable.isDataTable('#result')){
                        table.destroy();
                    }
                    cari.config.kirim = false;
                    var index = 1;
                    $('#result tbody tr').remove();
                    //var proposal = JSON.parse(response.proposal);
                    var num = response.proposal.length;
                    for(var i=0;i<num;i++){
                        $('#result tbody:last').append('' +
                            '<tr><td width="20px">'+index+'</td>' +
                            '<td width="100px">'+response.proposal[i].fullname+'</td>' +
                            '<td width="50px">' + response.proposal[i].status+'</td>' +
                            '<td width="20px">' + response.proposal[i].id+'</td>' +
                            '<td width="400px"><a href="'+host+'/admin/reviewer/proposal/'+response.proposal[i].id+'/5/masuk" onClick="window.open(this.href,\'targetWindow\');return false;">' + response.proposal[i].judul+'</a></td></tr>');
                        index++;
                    }
                    if (!$.fn.DataTable.isDataTable('#result')){
                        table = $('#result').DataTable({
                            "searching": true,
                            "ordering": true,
                            "paging": true,
                            "info": true
                        });
                    }
                    $('#divResult').css('display','block');
                    toastr["success"]('Tampilkan hasil pencarian','Success');

                }
            },
            error: function (response) {
                alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                //document.write(response.responseText);
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        cari.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnCari').on('click',function(){
    var json= '{"sender":"bic"' +
        ',"nama_inovator":"'+$('#namaInovator').val()+'"' +
        ',"nomor_proposal":"'+$('#nomorProposal').val()+'"' +
        ',"judul_proposal":"'+$('#judulProposal').val()+'"' +
        ',"keyword_proposal":"'+$('#keywordProposal').val()+'"' +
        ',"status_proposal":"'+$('#selStatusProposal').val()+'"}';
    alert(json);
    cari.cariProposal(json);
});