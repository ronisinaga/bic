/**
 * Created by alienware on 12/24/2017.
 */
var wizard = {
    config: {
        tabIndex: parseInt(tabValue),
        tabName: 'naratif',
        btnNext: $('#btnNext'),
        btnBefore: $('#btnBefore'),
        btnSave: $('#btnSave'),
        tabNaratif: $('#stepNaratif'),
        tabPendukung: $('#stepDataPendukung'),
        tabFile: $('#stepFile'),
        formNaratif: $('#naratif'),
        formPendukung: $('#data_pendukung'),
        formFile: $('#data_file'),
        kirim:false,
        file: null
    },
    init: function(settings){
        $.extend(wizard.config,settings);
        wizard.setup();
    },
    setup: function(){
        switch(wizard.config.tabIndex){
            case 1:
                wizard.config.tabNaratif.addClass('done').addClass('active');
                wizard.config.tabPendukung.removeClass('done').removeClass('active');
                wizard.config.tabFile.removeClass('done').removeClass('active');
                wizard.config.formNaratif.css({display:'block'});
                wizard.config.formPendukung.css({display:'none'});
                wizard.config.formFile.css({display:'none'});
                wizard.config.btnBefore.attr({disabled:'disabled'});
                break;
            case 2:
                wizard.config.tabNaratif.removeClass('done').removeClass('active');
                wizard.config.tabPendukung.addClass('done').addClass('active');
                wizard.config.tabFile.removeClass('done').removeClass('active');
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'block'});
                wizard.config.formFile.css({display:'none'});
                break;
            case 3:
                wizard.config.tabNaratif.removeClass('done').removeClass('active');
                wizard.config.tabPendukung.removeClass('done').removeClass('active');
                wizard.config.tabFile.addClass('done').addClass('active');
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'none'});
                wizard.config.formFile.css({display:'block'});
                wizard.config.btnNext.attr({disabled:'disabled'});
                wizard.config.btnNext.html('Berikutnya <i class="fa fa-arrow-right"></i> ');
                break;
        }

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "onHidden": function() {
                if (wizard.config.kirim){
                    wizard.redirectToPage(host+'/admin/inovator/proposal/'+$('#id').val()+'/lengkapi');
                }
                //
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

    },
    stepForward: function(tabIndex){
        switch (tabIndex){
            case 1:
                wizard.config.tabIndex = 2;
                wizard.config.tabNaratif.removeClass('done').removeClass('active');
                wizard.config.tabPendukung.addClass('done').addClass('active');
                wizard.config.btnBefore.removeAttr('disabled');
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'block'});
                wizard.config.formFile.css({display:'none'});
                break;
            case 2:
                wizard.config.tabIndex = 3;
                wizard.config.tabPendukung.removeClass('done').removeClass('active');
                wizard.config.tabFile.addClass('done').addClass('active');
                //wizard.config.btnNext.text('Simpan');
                //wizard.config.btnNext.html('<i class="fa fa-save"></i> Simpan');
                wizard.config.btnNext.attr({disabled:'disabled'});
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'none'});
                wizard.config.formFile.css({display:'block'});
                break;
            case 3:
                break;
        }
    },
    stepBackward: function(tabIndex){
        switch (tabIndex){
            case 1:
                break;
            case 2:
                wizard.config.tabIndex = 1;
                wizard.config.tabPendukung.removeClass('done').removeClass('active');
                wizard.config.tabNaratif.addClass('done').addClass('active');
                wizard.config.btnBefore.attr({disabled:'disabled'});
                wizard.config.formNaratif.css({display:'block'});
                wizard.config.formPendukung.css({display:'none'});
                wizard.config.formFile.css({display:'none'});
                break;
            case 3:
                wizard.config.tabIndex = 2;
                wizard.config.tabFile.removeClass('done').removeClass('active');
                wizard.config.tabPendukung.addClass('done').addClass('active');
                wizard.config.btnNext.html('Berikutnya <i class="fa fa-arrow-right"></i> ');
                wizard.config.btnNext.removeAttr('disabled');
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'block'});
                wizard.config.formFile.css({display:'none'});
                break;
        }
    },
    stepCertainTab: function(tabName){
        switch(tabName){
            case 'naratif':
                wizard.config.tabNaratif.addClass('done').addClass('active');
                wizard.config.tabPendukung.removeClass('done').removeClass('active');
                wizard.config.tabFile.removeClass('done').removeClass('active');
                wizard.config.formNaratif.css({display:'block'});
                wizard.config.formPendukung.css({display:'none'});
                wizard.config.formFile.css({display:'none'});
                wizard.config.btnBefore.attr({disabled:'disabled'});
                wizard.config.btnNext.removeAttr('disabled');
                //wizard.config.btnNext.text('Selanjutnya');
                wizard.config.tabIndex = 1;
                break;
            case 'dataPendukung':
                wizard.config.tabPendukung.addClass('done').addClass('active');
                wizard.config.tabFile.removeClass('done').removeClass('active');
                wizard.config.tabNaratif.removeClass('done').removeClass('active');
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'block'});
                wizard.config.formFile.css({display:'none'});
                wizard.config.btnBefore.removeAttr('disabled');
                wizard.config.btnNext.removeAttr('disabled');
                //wizard.config.btnNext.text('Selanjutnya');
                wizard.config.btnNext.html('Berikutnya <i class="fa fa-arrow-right"></i> ');
                wizard.config.tabIndex = 2;
                break;
            case 'file':
                wizard.config.tabFile.addClass('done').addClass('active');
                wizard.config.tabPendukung.removeClass('done').removeClass('active');
                wizard.config.tabNaratif.removeClass('done').removeClass('active');
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'none'});
                wizard.config.formFile.css({display:'block'});
                wizard.config.btnBefore.removeAttr('disabled');
                wizard.config.btnNext.attr({disabled:'disabled'});
                //$('#btnNext').attr('text','<i class="fa fa-save"></i> Simpan');
                wizard.config.btnNext.html('Berikutnya <i class="fa fa-arrow-right"></i> ');
                wizard.config.tabIndex = 3;
                break;
        }
    },
    save: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/proposal/save',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == 'success'){
                    toastr['success']("Sistem berhasil update data proposal data kedalam database","Success");
                }
            },
            error: function (response) {
                alert(response.responseText);
            }
        });
    },
    redirectToPage : function(page){
        window.location = page;
    },
    loadKunciTeknologiLevel2 : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/katakunci/findKataKunci',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                var len = response.length;
                if (len != 0){
                    //$("#tblTeknologiLevel3 tbody > tr").remove();
                    $('#addTeknologi').prop('disabled',true);
                    $('#selKunciTeknologiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Teknologi Level 3 -- </option>");
                    $('#selKunciTeknologiLev2').empty().append("<option value='0'>-- Pilih Kata Kunci Teknologi Level 2 -- </option>");
                    for(var i=0;i<len;i++){
                        $('#selKunciTeknologiLev2').append("<option value='"+response[i].id+"'> "+response[i].kata_kunci+"</options>");
                    }

                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    toastr["info"]('Tidak ada pada level 2','Info');
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
    },
    loadKunciTeknologiLevel3 : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/katakunci/findKataKunci',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                var len = response.length;
                if (len != 0){
                    //$("#tblTeknologiLevel3 tbody > tr").remove();
                    $('#selKunciTeknologiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Level 3 --</option>");
                    $('#addTeknologi').prop('disabled',false);
                    for(var i=0;i<len;i++){
                        $('#selKunciTeknologiLev3').append("<option value='"+response[i].id+"'>"+response[i].kata_kunci+"</options>");
                    }

                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    $('#addTeknologi').prop('disabled',false);
                    //$("#tblTeknologiLevel3 tbody > tr").remove();
                    $('#selKunciTeknologiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Teknologi Level 3 --</option>");
                    toastr["info"]('Tidak ada pada level 3','Info');
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
    },
    loadKunciAplikasiLevel2 : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/katakunci/findKataKunci',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                var len = response.length;
                if (len != 0){
                    //$("#tblAplikasiLevel3 tbody > tr").remove();
                    $('#addAplikasi').prop('disabled',true);
                    $('#selKunciAplikasiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Aplikasi Level 3 --</option>");
                    $('#selKunciAplikasiLev2').empty().append("<option value='0'>-- Pilih Kata Kunci Aplikasi Level 2 --</option>");
                    for(var i=0;i<len;i++){
                        $('#selKunciAplikasiLev2').append("<option value='"+response[i].id+"'>"+response[i].kata_kunci+"</options>");
                    }

                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    toastr["info"]('Tidak ada pada level 2','Info');
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
    },
    loadKunciAplikasiLevel3 : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/katakunci/findKataKunci',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                var len = response.length;
                if (len != 0){
                    //$("#tblAplikasiLevel3 tbody > tr").remove();
                    $('#selKunciAplikasiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Aplikasi Level 3 --</option>");
                    $('#addAplikasi').prop('disabled',false);
                    for(var i=0;i<len;i++){
                        $('#selKunciAplikasiLev3').append("<option value='"+response[i].id+"'>"+response[i].kata_kunci+"</options>");
                    }

                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    $('#addAplikasi').prop('disabled',false);
                    //$("#tblAplikasiLevel3 tbody > tr").remove();
                    $('#selKunciAplikasiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Aplikasi Level 3 --</option>");
                    toastr["info"]('Tidak ada pada level 3','Info');
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
    },
    loadKolaborasi : function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/katakunci/findKataKunci',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                var len = response.length;
                if (len != 0){
                    $('#cbxKolaborasi').empty();
                    for(var i=0;i<len;i++){
                        $('#cbxKolaborasi').append('<label><input type="checkbox" id="itemKolaborasi" name="itemKolaborasi" value="'+response[i].id+'" text="'+response[i].kata_kunci+'"> '+response[i].kata_kunci+'</label>');
                    }

                }else{
                    //alert("Tidak ada data kecamatan terkait kabupaten yang dipilih");
                    $('#cbxKolaborasi').empty();
                    toastr["info"]('Tidak ada pada level 2','Info');
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
    },
    saveProposalMember: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/proposal/saveProposalMember',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    toastr["success"]('Berhasil menambahkan data member yang berkaitan dengan Inovator','Success');
                    $('#popupAddMember').modal('hide');
                    $('#popupNama').val('');
                    $('#popupInstitusi').val('');
                    $('#popupEmail').val('');
                    $('#popupTelepon').val('');
                    $('#popupAlamat').val('');
                    $("#tblInovatorMember tbody > tr").empty();
                    var num =  response.member.length;
                    for(var i=0;i<num;i++){
                        var index = i+1;
                        $("#tblInovatorMember tbody:last").append('<tr><td>'+index+'</td><td style="display: none">'+response.member[i].id+'</td><td style="display: none">'+response.member[i].email+'</td><td style="display: none">'+response.member[i].telp+'</td><td style="display: none">'+response.member[i].alamat+'</td><td>'+response.member[i].name+'</td><td style="display: none">'+response.member[i].institusi+'</td><td><button type="button" class="btn blue" id="pilihMember" name="pilihMember"><i class="fa fa-check"></i> Pilih</button><button type="button" class="btn green" id="editMember" name="editMember"><i class="fa fa-pencil"></i> Edit</button><button type="button" class="btn red" id="removeMember" name="removeMember"><i class="fa fa-remove"></i> Hapus</button></td>');
                    }
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
    },
    updateProposalMember: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/proposal/updateProposalMember',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    toastr["success"]('Berhasil update data member yang berkaitan dengan Inovator','Success');
                    $('#popupEditMember').modal('hide');
                    $("#tblInovatorMember tbody > tr").empty();
                    var num =  response.member.length;
                    for(var i=0;i<num;i++){
                        var index = i+1;
                        $("#tblInovatorMember tbody:last").append('<tr><td>'+index+'</td><td style="display: none">'+response.member[i].id+'</td><td style="display: none">'+response.member[i].email+'</td><td style="display: none">'+response.member[i].telp+'</td><td style="display: none">'+response.member[i].alamat+'</td><td>'+response.member[i].name+'</td><td style="display: none">'+response.member[i].institusi+'</td><td><button type="button" class="btn blue" id="pilihMember" name="pilihMember"><i class="fa fa-check"></i> Pilih</button><button type="button" class="btn green" id="editMember" name="editMember"><i class="fa fa-pencil"></i> Edit</button><button type="button" class="btn red" id="removeMember" name="removeMember"><i class="fa fa-remove"></i> Hapus</button></td>');
                    }
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
    },
    deleteProposalMember: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/proposal/deleteProposalMember',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    wizard.config.kirim = false;
                    toastr["success"]('Berhasil hapus data member yang berkaitan dengan Inovator','Success');
                    $('#popupAddMember').modal('hide');
                    $('#popupEditNama').val('');
                    $('#popupEditInstitusi').val('');
                    $('#popupEditEmail').val('');
                    $('#popupEditTelepon').val('');
                    $('#popupEditAlamat').val('');
                    $("#tblInovatorMember tbody > tr").empty();
                    var num =  response.member.length;
                    for(var i=0;i<num;i++){
                        var index = i+1;
                        $("#tblInovatorMember tbody:last").append('<tr><td>'+index+'</td><td style="display: none">'+response.member[i].id+'</td><td>'+response.member[i].name+'</td><td><button type="button" class="btn blue" id="pilihMember" name="pilihMember"><i class="fa fa-check"></i> Pilih</button><button type="button" class="btn green" id="editMember" name="editMember"><i class="fa fa-pencil"></i> Edit</button><button type="button" class="btn red" id="removeMember" name="removeMember"><i class="fa fa-remove"></i> Hapus</button></td>');
                    }
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
    },
    uploadFile : function(){
        //form = document.forms.namedItem("formUpload");
        var data = new FormData();
        data.append('id_proposal',$('#id').val());
        //check ukuran file
        for(var i=0;i<wizard.config.file.length;i++){
            var file = wizard.config.file[i];
            if (file.size > 1048576){
                wizard.config.kirim = false;
                toastr["error"]('Ukuran file terlalu besar. Maksimum ukuran file adalah 1 MB','Error');
            }else{
                var type = '';
                allowable = true;
                //alert(file.type);
                switch (file.type){
                    case 'image/jpg':
                        type ='image';
                        break;
                    case 'image/png':
                        type ='image';
                        break;
                    case 'image/gif':
                        type ='image';
                        break;
                    case 'image/jpeg':
                        type ='image';
                        break;
                    case 'image/bmp':
                        type ='image';
                        break;
                    case 'application/pdf':
                        type ='pdf';
                        break;
                    case 'application/msword':
                        type ='doc';
                        break;
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                        type ='docx';
                        break;
                    case 'application/vnd.ms-excel':
                        type ='xls';
                        break;
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                        type ='xlsx';
                        break;
                    case 'application/vnd.ms-powerpoint':
                        type ='ppt';
                        break;
                    case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                        type ='pptx';
                        break;
                    default:
                        allowable = false;
                        break;
                }
                if (allowable){
                    data.append('file',file);
                    data.append('tipe',type);
                    $.ajax({
                        method: 'POST',
                        url: host+'/admin/inovator/proposal/uploadFile',
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function (response){
                            if (response.status == "success"){
                                wizard.config.kirim = false;
                                toastr["success"]('Berhasil upload file yang berkaitan dengan proposal','Success');
                                $('#popupUploadFile').modal('hide');
                                $("#tblFileProposal tbody > tr").empty();
                                 var num =  response.files.length;
                                 for(var i=0;i<num;i++){
                                     var index = i+1;
                                     $("#tblFileProposal tbody:last").append('<tr><td>'+index+'</td><td style="display: none">'+response.files[i].id+'</td><td><a href="/bic_new/public'+response.files[i].public_path+'">'+response.files[i].file+'</a></td><td><button type="button" class="btn red" id="deleteFile" name="deleteFile"><i class="fa fa-remove"></i> Hapus</button></td>');
                                 }
                                 if (num == 3){
                                     $('#tambahFile').prop('disabled',true);
                                 }else{
                                     $('#tambahFile').prop('disabled',false);
                                 }
                            }else{
                                toastr["error"]('Gagal upload file yang berkaitan dengan proposal','Error');
                            }
                        },
                        error: function (response) {
                            //alert(response.responseText);
                            document.write(response.responseText);
                            //toastr['error'](response.responseText,"Error");
                            //$('#loadingDiv').removeClass('show');
                            //$('#loadingDiv').addClass('hide');
                            //document.write(response.responseText);
                        }
                    });
                }else{
                    wizard.config.kirim = false;
                    toastr["error"]("Tipe File tidak dikenali. Tipe file yang dikenali adalah image (png,jpg,jpeg,gif dan bmp), pdf, doc,docx, xls, xlsx, ppt, pptx","Error");
                }
            }
        }
    },
    deleteFile: function(json){
        $.ajax({
            method: 'POST',
            url: host+'/admin/inovator/proposal/deleteFile',
            data: {
                data: json
            },
            dataType: "json",
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (response){
                if (response.status == "success"){
                    wizard.config.kirim = false;
                    toastr["success"]('Berhasil hapus file yang berkaitan dengan proposal inovasi','Success');
                    $("#tblFileProposal tbody > tr").empty();
                    var num =  response.proposalFile.length;
                    for(var i=0;i<num;i++){
                        var index = i+1;
                        $("#tblFileProposal tbody:last").append('<tr><td>'+index+'</td><td style="display: none">'+response.proposalFile[i].id+'</td><td><a href="/bic_new/public'+response.proposalFile[i].public_path+'">'+response.proposalFile[i].file+'</a></td><td><button type="button" class="btn red" id="deleteFile" name="deleteFile"><i class="fa fa-remove"></i> Hapus</button></td>');
                    }
                    if (num == 3){
                        $('#tambahFile').prop('disabled',true);
                    }else{
                        $('#tambahFile').prop('disabled',false);
                    }
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

};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        wizard.init({});
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
}

$('#btnSimpan').on('click',function(){
    //var parent_teknologi = [$('#selKunciTeknologiLev1').val(),$('#selKunciTeknologiLev2').val()];
    var kata_kunci_teknologi = [];
    $('#tblTeknologiLevel3 tbody > tr').each(function(i,row) {
        $row = $(row);
        $cols = $row.find('td');
        kata_kunci_teknologi.push([$($cols[1]).text(),$($cols[3]).text(),$($cols[5]).text()]);
    });

    //var parent_aplikasi = [$('#selKunciAplikasiLev1').val(),$('#selKunciAplikasiLev2').val()];
    var kata_kunci_aplikasi = [];
    $('#tblAplikasiLevel3 tbody > tr').each(function(i,row) {
        $row = $(row);
        $cols = $row.find('td');
        kata_kunci_aplikasi.push([$($cols[1]).text(),$($cols[3]).text(),$($cols[5]).text()]);
    });

    /*var parent_kolaborasi = [$('#selKolaborasi').val()];
    var kolaborasi = [];
    $('#cbxKolaborasi input:checked').each(function() {
        kolaborasi.push($(this).attr('value'));
    });*/
    var kolaborasi = [];
    $('#tblKolaborasi tbody > tr').each(function(i,row) {
        $row = $(row);
        $cols = $row.find('td');
        $member = [$($cols[1]).text(),$($cols[3]).text()];
        kolaborasi.push($member);
    });

    var instansi = [];
    if ($('#institusi').val() != ""){
        instansi[0] = $('#institusi').val();
        /*bidang = [];
        $('#cbxBidang input:checked').each(function() {
            bidang.push($(this).attr('value'));
        });*/
        //instansi[1] = bidang;
        instansi[1] = [$("input:radio[name='instansi']:checked").val()];
        instansi[2] = $('#selEmployee').val();
    }

    var proposalInovatorMember = [];
    $('#tblChosenInovatorMember tbody > tr').each(function(i,row) {
        $row = $(row);
        $cols = $row.find('td');
        $member = [$($cols[1]).text(),$($cols[3]).text()];
        proposalInovatorMember.push($member);
    });

    var proposalUrl = [];
    $('#tblUrlProposal tbody > tr').each(function(i,row) {
        $row = $(row);
        cols = $row.find('td');
        url = [$(cols[1]).text(),$(cols[2]).text()];
        proposalUrl.push(url);
    });

    var arr ={
        'id_proposal':$('#id').val(),
        'abstrak':CKEDITOR.instances['abstrak'].getData(),
        'deskripsi':CKEDITOR.instances['deskripsi'].getData(),
        'keunggulan_teknologi':CKEDITOR.instances['keunggulan_teknologi'].getData(),
        'potensi_aplikasi':CKEDITOR.instances['potensi_aplikasi'].getData(),
        'id_development':$('#selDevelopment').val(),
        'id_ipr':$('#selIPR').val(),
        'ipr_value':$('#noPatent').val(),
        'id_arn':$('#selARN').val(),
        'catatan':$('#catatan').val(),
        //'parent_teknologi':parent_teknologi,
        'kata_kunci_teknologi':kata_kunci_teknologi,
        //'parent_aplikasi':parent_aplikasi,
        'kata_kunci_aplikasi':kata_kunci_aplikasi,
        //'parent_kolaborasi':parent_kolaborasi,
        'kolaborasi':kolaborasi,
        'instansi':instansi,
        'proposalInovatorMember':proposalInovatorMember,
        'proposalUrl':proposalUrl
    };
    //var json = '{"id_proposal":"'+$('#id').val()+'","abstrak":"'+abstrak+'","deskripsi":"'+deskripsi+'","keunggulan_teknologi":"'+keunggulan_teknologi+'","potensi_aplikasi":"'+potensi_aplikasi+'"}';
    //alert(json);
    var json = JSON.stringify(arr);
    wizard.config.kirim = true;
    wizard.save(json);
});

$('#btnNext').on('click',function(){
    wizard.stepForward(wizard.config.tabIndex);
});

$('#btnBefore').on('click',function(){
    wizard.stepBackward(wizard.config.tabIndex);
});

$('#stepDataPendukung').on('click',function(){
    wizard.stepCertainTab('dataPendukung');
});

$('#stepNaratif').on('click',function(){
    wizard.stepCertainTab('naratif');
});

$('#stepFile').on('click',function(){
    wizard.stepCertainTab('file');
});

$('#selKunciTeknologiLev1').on('change',function(){
    if ($(this).val() == '0'){
        /*$("#tblTeknologiLevel3 tbody > tr").remove();
        $('#selKunciTeknologiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Teknologi Level 3 --</option>");
        $('#selKunciTeknologiLev2').empty().append("<option value='0'>-- Pilih Kata Kunci Teknologi Level 2 --</option>");*/
    }else {
        var json = '{"sender":"bic","id":' + $('#selKunciTeknologiLev1').val() + '}';
        wizard.loadKunciTeknologiLevel2(json);
    }
});

$('#selKunciTeknologiLev2').on('change',function(){
    if ($(this).val() == '0'){
        $("#tblTeknologiLevel3 tbody > tr").remove();
        $('#selKunciTeknologiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Teknologi Level 3 --</option>");
    }else {
        var json = '{"sender":"bic","id":' + $('#selKunciTeknologiLev2').val() + '}';
        wizard.loadKunciTeknologiLevel3(json);
    }
});

$('#selKunciAplikasiLev1').on('change',function(){
    if ($(this).val() == '0'){
        /*$("#tblAplikasiLevel3 tbody > tr").remove();
        $('#selKunciAplikasiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Aplikasi Level 3 --</option>");
        $('#selKunciAplikasiLev2').empty().append("<option value='0'>-- Pilih Kata Kunci Aplikasi Level 2 --</option>");*/
    }else{
        var json = '{"sender":"bic","id":'+$('#selKunciAplikasiLev1').val()+'}';
        wizard.loadKunciAplikasiLevel2(json);
    }
});

$('#selKunciAplikasiLev2').on('change',function(){
    if ($(this).val() == '0'){
        $("#tblAplikasiLevel3 tbody > tr").remove();
        $('#selKunciAplikasiLev3').empty().append("<option value='0'>-- Pilih Kata Kunci Aplikasi Level 3 --</option>");
    }else{
        var json = '{"sender":"bic","id":'+$('#selKunciAplikasiLev2').val()+'}';
        wizard.loadKunciAplikasiLevel3(json);
    }
});

$('#addTeknologi').on('click',function(){
    var rows = $('#selKunciTeknologiLev3 option').length;
    if (rows == 1){
        var length = $('#tblTeknologiLevel3 tr').length;
        $("#tblTeknologiLevel3 tbody:last").append('<tr><td>'+length+'</td><td style="display: none">0</td><td></td>' +
            '<td style="display: none;">'+$('#selKunciTeknologiLev2').val()+'</td><td>'+$("#selKunciTeknologiLev2 option:selected").text()+'</td>' +
            '<td style="display: none">'+$("#selKunciTeknologiLev1").val()+'</td><td>'+$("#selKunciTeknologiLev1 option:selected").text()+'</td>' +
            '<td><button type="button" class="btn red" id="removeTeknologi" name="removeTeknologi"><i class="fa fa-remove"></i> Hapus</button></td></tr>');
    }else{
        var kategori = $('#selKunciTeknologiLev3').val();
        if (kategori == '0'){
            toastr["error"]('Salah satu kunci teknologi harus dipilih terlebih dahulu','Error');
        }else{
            var length = $('#tblTeknologiLevel3 tr').length;
            $("#tblTeknologiLevel3 tbody:last").append('<tr><td>'+length+'</td><td style="display: none">'+$('#selKunciTeknologiLev3').val()+'</td>' +
                '<td>'+$("#selKunciTeknologiLev3 option:selected").text()+'</td><td style="display: none">'+$('#selKunciTeknologiLev2').val()+'</td>' +
                '<td>'+$("#selKunciTeknologiLev2 option:selected").text()+'</td><td style="display: none">'+$('#selKunciTeknologiLev1').val()+'</td>' +
                '<td>'+$("#selKunciTeknologiLev1 option:selected").text()+'</td>' +
                '<td><button type="button" class="btn red" id="removeTeknologi" name="removeTeknologi"><i class="fa fa-remove"></i> Hapus</button></td></tr>');
        }
    }
});

$('#addTeknologiLevel2').on('click',function(){
    var kategori = $('#selKunciTeknologiLev2').val();
    if (kategori == '0'){
        toastr["error"]('Salah satu kunci teknologi harus dipilih terlebih dahulu','Error');
    }else{
        var length = $('#tblTeknologiLevel3 tr').length;
        $("#tblTeknologiLevel3 tbody:last").append('<tr><td>'+length+'</td><td style="display: none">'+$('#selKunciTeknologiLev2').val()+'</td><td>'+$("#selKunciTeknologiLev2 option:selected").text()+'</td><td><button type="button" class="btn red" id="removeTeknologi" name="removeTeknologi"><i class="fa fa-remove"></i> Hapus</button></td></tr>');
    }
});

$('#tblTeknologiLevel3').on('click','#removeTeknologi',function(){
    $(this).closest('tr').remove();
    //$(this).parents('tr').first().remove();
});

$('#addAplikasi').on('click',function(){
    var rows = $('#selKunciAplikasiLev3 option').length;
    if (rows == 1){
        var length = $('#tblAplikasiLevel3 tr').length;
        $("#tblAplikasiLevel3 tbody:last").append('<tr><td>'+length+'</td><td style="display: none">0</td><td></td>' +
            '<td style="display: none">'+$('#selKunciAplikasiLev2').val()+'</td><td>'+$("#selKunciAplikasiLev2 option:selected").text()+'</td>' +
            '<td style="display: none">'+$('#selKunciAplikasiLev1').val()+'</td><td>'+$("#selKunciAplikasiLev1 option:selected").text()+'</td>' +
            '<td><button type="button" class="btn red" id="removeAplikasi" name="removeAplikasi"><i class="fa fa-remove"></i> Hapus</button></td></tr>');
    }else{
        var kategori = $('#selKunciAplikasiLev3').val();
        if (kategori == '0'){
            toastr["error"]('Salah satu kunci aplikasi harus dipilih terlebih dahulu','Error');
        }else{
            var length = $('#tblAplikasiLevel3 tr').length;
            $("#tblAplikasiLevel3 tbody:last").append('<tr><td>'+length+'</td><td style="display: none">'+$('#selKunciAplikasiLev3').val()+'</td>' +
                '<td>'+$("#selKunciAplikasiLev3 option:selected").text()+'</td><td style="display: none">'+$("#selKunciAplikasiLev2").val()+'</td>' +
                '<td>'+$("#selKunciAplikasiLev2 option:selected").text()+'</td><td style="display: none">'+$("#selKunciAplikasiLev1").val()+'</td>' +
                '<td>'+$("#selKunciAplikasiLev1 option:selected").text()+'</td><td><button type="button" class="btn red" id="removeAplikasi" name="removeAplikasi"><i class="fa fa-remove"></i> Hapus</button></td></tr>');
        }
    }
});

$('#addAplikasiLevel2').on('click',function(){
    var kategori = $('#selKunciAplikasiLev2').val();
    if (kategori == '0'){
        toastr["error"]('Salah satu kunci aplikasi harus dipilih terlebih dahulu','Error');
    }else{
        var length = $('#tblAplikasiLevel3 tr').length;
        $("#tblAplikasiLevel3 tbody:last").append('<tr><td>'+length+'</td><td style="display: none">'+$('#selKunciAplikasiLev2').val()+'</td><td>'+$("#selKunciAplikasiLev2 option:selected").text()+'</td><td><button type="button" class="btn red" id="removeAplikasi" name="removeAplikasi"><i class="fa fa-remove"></i> Hapus</button></td></tr>');
    }
});

$('#tblAplikasiLevel3').on('click','#removeAplikasi',function(){
    $(this).closest('tr').remove();
    //$(this).parents('tr').first().remove();
});

$('#selKolaborasi').on('change',function(){
    if ($('#selKolaborasi').val() == '0'){
        $('#cbxKolaborasi').empty();
        $('#tambahKolaborasi').prop('disabled',true);
    }else{
        $('#tambahKolaborasi').prop('disabled',false);
        var json = '{"sender":"bic","id":'+$('#selKolaborasi').val()+'}';
        wizard.loadKolaborasi(json);
    }
});

$('#tambahKolaborasi').on('click',function(){
    var index = $('#tblKolaborasi tr').length;
    if ($('#cbxKolaborasi input:checked').length == 0){
        $('#tblKolaborasi tbody:last').append('<tr><td>'+index+'</td><td style="display: none">'+$('#selKolaborasi').val()+'</td><td>'
            + $('#selKolaborasi option:selected').text()+'</td><td style="display:none;">0</td><td></td><td>' +
            '<button type="button" class="btn red" id="removeKolaborasi" name="removeKolaborasi"><i class="fa fa-trash"></i> Hapus</button></td></tr>');
    }else{
        $('#cbxKolaborasi input:checked').each(function() {
            //kolaborasi.push($(this).attr('value'));
            $('#tblKolaborasi tbody:last').append('<tr><td>'+index+'</td><td style="display: none">'+$('#selKolaborasi').val()+'</td><td>'
                + $('#selKolaborasi option:selected').text()+'</td><td style="display:none;">'+$(this).attr('value')+'</td><td>'
                +$(this).attr('text')+'</td><td><button type="button" class="btn red" id="removeKolaborasi" name="removeKolaborasi"><i class="fa fa-trash"></i> Hapus</button></td></tr>');
            index++;
        });
    }
});

$('#tblKolaborasi').on('click','#removeKolaborasi',function(){
    $(this).closest('tr').remove();
});

$('#tambahTim').on('click',function(){
    $('#popupAddMember').modal();
    $( "#popupInstitusi" ).autocomplete( "option", "appendTo", "#popupAddMember" );
});

$('#popupInstitusi').autocomplete({
    source: host+'/admin/inovator/proposal/findProposalMemberInstitusi',
    minLength:1,
    autoFocus:true
    //source: ["Pisang","Mangga","Jambu"]
});

$('#tambahMember').on('click',function(){
    wizard.config.kirim = false;
    var isValid = true;
    if ($('#popupNama').val() == ""){
        isValid = false;
        toastr["error"]("Nama tidak boleh kosong","Error");
    }
    if ($('#popupEmail').val() == ""){
        isValid = false;
        toastr["error"]("Email tidak boleh kosong","Error");
    }
    if ($('#popupInstitusi').val() == ""){
        isValid = false;
        toastr["error"]("Institusi tidak boleh kosong","Error");
    }
    if (isValid){
        var json = '{"sender":"bic","name":"'+$('#popupNama').val()+'","institusi":"'+$('#popupInstitusi').val()+'","email":"'+$('#popupEmail').val()+'","telp":"'+$('#popupTelepon').val()+'","alamat":"'+$('#popupAlamat').val()+'"}';
        wizard.saveProposalMember(json);
    }
});

$('#tblInovatorMember').on('click','#removeMember',function(){
    wizard.config.kirim = false;
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var json = '{"sender":"bic","id":"'+$($cols[1]).text()+'"}';
    wizard.deleteProposalMember(json);
    $(this).closest('tr').remove();
    //$(this).parents('tr').first().remove();
});

$('#tblInovatorMember').on('click','#editMember',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    $('#popupEditNama').val($($cols[5]).text());
    $('#popupEditID').val($($cols[1]).text());
    $('#popupEditEmail').val($($cols[2]).text());
    $('#popupEditTelepon').val($($cols[3]).text());
    $('#popupEditAlamat').val($($cols[4]).text());
    $('#popupEditInstitusi').val($($cols[6]).text());
    $('#popupEditMember').modal();
});

$('#updateMember').on('click',function(){
    wizard.config.kirim = false;
    var valid = true;
    if ($('#popupEditNama').val() == ""){
        valid = false;
        toastr['error']('Nama tidak boleh kosong','Error');
    }
    if($('#popupEditInstitusi').val() == ""){
        valid = false;
        toastr['error']('Institusi tidak boleh kosong','Error');
    }
    if ($('#popupEditEmail').val() == ""){
        valid = false;
        toastr['error']('Email tidak boleh kosong','Error');
    }
    if (valid){
        var json = '{"sender":"bic","id":"'+$('#popupEditID').val()+'","name":"'+$('#popupEditNama').val()+'","institusi":"'+$('#popupEditInstitusi').val()+'","email":"'+$('#popupEditEmail').val()+'","telp":"'+$('#popupEditTelepon').val()+'","alamat":"'+$('#popupEditAlamat').val()+'"}';
        wizard.updateProposalMember(json);
    }
});

$('#tblInovatorMember').on('click','#pilihMember',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    $('#popupPilihNama').val($($cols[5]).text());
    $('#popupPilihID').val($($cols[1]).text());
    $('#popupPilihMember').modal();
});

$('#chooseMember').on('click',function(){
    if ($('#selRSC').val() == '0'){
        toastr["error"]('Posisi Inovator belum dipilih','Error');
    }else {
        var isValid = true;
        $('#popupPilihMember').modal('hide');
        var length = $('#tblChosenInovatorMember tr').length;
        var found = false;
        $('#tblChosenInovatorMember tbody > tr').each(function (i, row) {
            $row = $(row);
            $cols = $row.find('td');
            if (($('#selRSC').val() == '1') || ($('#selRSC').val() == '3')) {
                if ($($cols[3]).text() == $('#selRSC').val()) {
                    found = true;
                }
            }
        });
        if (found) {
            toastr["error"]("Peneliti utama atau kontak utama tidak boleh lebih dari 1 orang", "Error");
        } else {
            $("#tblChosenInovatorMember tbody:last").append('<tr><td>' + length + '</td><td style="display: none">' + $('#popupPilihID').val() + '</td><td>' + $('#popupPilihNama').val() + '</td><td style="display: none">' + $('#selRSC').val() + '</td><td>' + $("#selRSC option:selected").text() + '</td><td><button type="button" class="btn blue" id="editChosenMember" name="editChosenMember"><i class="fa fa-pencil"></i> Edit</button><button type="button" class="btn red" id="hapusChosenMember" name="hapusChosenMember"><i class="fa fa-remove"></i> Hapus</button></td>');
        }
    }
});

$('#tblChosenInovatorMember').on('click','#editChosenMember',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    $('#popupEditChosenNama').val($($cols[2]).text());
    $('#popupEditChosenID').val($($cols[1]).text());
    $('#popupSelChosenID').val($($cols[3]).text());
    $('#selEditChosenRSC').val($($cols[3]).text());
    $('#popupEditChosenMember').modal();
});

$('#updateChosenMember').on('click',function(){
    if ($('#selEditChosenRSC').val() == '0'){
        toastr["error"]('Posisi Inovator belum dipilih','Error');
    }else{
        $('#popupEditChosenMember').modal('hide');
        $('#tblChosenInovatorMember tbody > tr').each(function(i,row) {
            $row = $(row);
            $cols = $row.find('td');
            if ($($cols[3]).text() == $('#popupSelChosenID').val()){
                $($cols[3]).html($("#selEditChosenRSC").val());
                $($cols[4]).html($("#selEditChosenRSC option:selected").text());
            }
        });
        $('#popupSelChosenID').val('0')
    }
});

$('#tblChosenInovatorMember').on('click','#hapusChosenMember',function(){
    $(this).closest('tr').remove();
    //$(this).parents('tr').first().remove();
});

$('#tambahFile').on('click',function() {
    $('#popupUploadFile').modal();
});

$('input[type=file]').on('change', function(event){
    wizard.config.file = event.target.files;
});

$('form').on('submit',function(event){
    event.stopPropagation();
    event.preventDefault();
    wizard.uploadFile();
});

$('#tblFileProposal').on('click','#deleteFile',function(){
    $tr = $(this).closest('tr');
    $cols = $tr.find('td');
    var json = '{"sender":"bic","id":'+$($cols[1]).text()+',"id_proposal":'+$('#id').val()+'}';
    wizard.deleteFile(json);
});

$('#selIPR').on('change',function(){
    var id = $('#selIPR').val();
    switch (id){
        case "1":
            $('#patent').css('display','block');
            break;
        case "2":
            $('#patent').css('display','block');
            break;
        case "3":
            $('#patent').css('display','none');
            break;
        case "4":
            $('#patent').css('display','none');
            break;
    }
});

$('#tblHistory').on('click','#detailMessage',function(){
    $row = $(this).closest('tr');
    $cols = $row.find('td');
    var isi = $($cols[5]).text();
    $('#isi').empty();
    $('#isi').append('<label class="control-label"><b>Isi Review</b></label><div class="keterangan"><table class="table table-striped table-bordered table-hover"><tbody><tr><td>'+isi+'</td></tr></tbody></table></div>');
});

$('#tambahUrl').on('click',function() {
    rows = $('#tblUrlProposal tr').length;
    $('#tblUrlProposal tbody').append('<tr><td>'+rows+'</td><td style="display: none">0</td><td><a href="'+$('#url').val()+'" target="_blank">'+$('#url').val()+'</a></td>' +
        '<td><button type="button" class="btn red" id="deleteURL" name="deleteURL"><i class="fa fa-remove"></i> Hapus URL</button></td></tr>');
    $('#url').val('');
    rows = $('#tblUrlProposal tr').length;
    if (rows == 4){
        $('#tambahUrl').prop('disabled', true);
    }
});

$('#tblUrlProposal').on('click','#deleteURL',function(){
    $tr = $(this).closest('tr').remove();
    rows = $('#tblUrlProposal tr').length;
    if (rows < 4){
        $('#tambahUrl').prop('disabled', false);
    }
});