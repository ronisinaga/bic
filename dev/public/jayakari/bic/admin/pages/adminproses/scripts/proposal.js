/**
 * Created by alienware on 1/4/2018.
 */

var proposal = {
    config: {

    },
    init: function(settings){
        $.extend(proposal.config,settings);
        proposal.setup();
    },
    setup: function(){

    },
    showDetail : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/adminproses/proposal/detail',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status=="success"){
                    toastr["success"]('Sukses update status proposal','Sukses');

                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    toastr["info"]('Tidak ada proposal pada batch ini','Info');
                }
            },
            error: function (response) {
                //alert(response.responseText);
                //toastr['error'](response.responseText,"Error");
                document.write(response.responseText);
            }
        });
    },

    redirectToPage : function(page){
        window.location = page;
    }
};

$('#new').on('click',function(){
    proposal.redirectToPage(host+'/admin/adminproses/proposal/create');
});

/*$('#tblProposal').on('click','#showDetail',function(event){
    event.stopPropagation();
    event.preventDefault();
    var row = $(this).closest('tr');
    var td = $(row).find('td');
    var json = '{"sender":"bic","id":'+$(td[2]).text()+'}';
    //alert(json);
    proposal.showDetail(json);
    //$('#popupViewProposal').modal();
});*/

$('#sebaranProposal').on('click',function(){
    $('#popupViewSebaranProposal').modal();
});