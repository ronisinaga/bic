/**
 * Created by alienware on 12/24/2017.
 */
var wizard = {
    config: {
        tabIndex: 1,
        tabName: 'naratif',
        btnNext: $('#btnNext'),
        btnBefore: $('#btnBefore'),
        btnSave: $('#btnSave'),
        tabNaratif: $('#stepNaratif'),
        tabPendukung: $('#stepDataPendukung'),
        tabFile: $('#stepFile'),
        formNaratif: $('#naratif'),
        formPendukung: $('#data_pendukung'),
        formFile: $('#data_file')
    },
    init: function(settings){
        $.extend(wizard.config,settings);
        wizard.setup();
    },
    setup: function(){
        wizard.config.btnBefore.attr({disabled:'disabled'});
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
                wizard.config.btnNext.text('Selesai');
                wizard.config.formFile.css({display:'block'});
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'none'});
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
                wizard.config.btnNext.text('Selanjutnya');
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
                wizard.config.btnNext.text('Selanjutnya');
                break;
            case 'dataPendukung':
                wizard.config.tabPendukung.addClass('done').addClass('active');
                wizard.config.tabFile.removeClass('done').removeClass('active');
                wizard.config.tabNaratif.removeClass('done').removeClass('active');
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'block'});
                wizard.config.formFile.css({display:'none'});
                wizard.config.btnBefore.removeAttr('disabled');
                wizard.config.btnNext.text('Selanjutnya');
                break;
            case 'file':
                wizard.config.tabFile.addClass('done').addClass('active');
                wizard.config.tabPendukung.removeClass('done').removeClass('active');
                wizard.config.tabNaratif.removeClass('done').removeClass('active');
                wizard.config.formNaratif.css({display:'none'});
                wizard.config.formPendukung.css({display:'none'});
                wizard.config.formFile.css({display:'block'});
                wizard.config.btnBefore.removeAttr('disabled');
                wizard.config.btnNext.text('Selesai');
                break;
        }
    },
    save: function(){

    }

};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
       wizard.init({});
    });
}

$('#btnNext').on('click',function(){
    var text = wizard.config.btnNext.text();
    switch (text){
        case 'Simpan':
            wizard.save();
            break;
        default:
            wizard.stepForward(wizard.config.tabIndex);
            break;
    }
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