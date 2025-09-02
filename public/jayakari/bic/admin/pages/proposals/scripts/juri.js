/**
 * Created by alienware on 12/24/2017.
 */
var penjurian = {
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
        $.extend(penjurian.config,settings);
        penjurian.setup();
    },
    setup: function(){
        penjurian.config.btnBefore.attr({disabled:'disabled'});
    },
    stepForward: function(tabIndex){
        switch (tabIndex){
            case 1:
                penjurian.config.tabIndex = 2;
                penjurian.config.tabNaratif.removeClass('done').removeClass('active');
                penjurian.config.tabPendukung.addClass('done').addClass('active');
                penjurian.config.btnBefore.removeAttr('disabled');
                penjurian.config.formNaratif.css({display:'none'});
                penjurian.config.formPendukung.css({display:'block'});
                break;
            case 2:
                penjurian.config.tabIndex = 3;
                penjurian.config.tabPendukung.removeClass('done').removeClass('active');
                penjurian.config.tabFile.addClass('done').addClass('active');
                penjurian.config.btnNext.text('Simpan');
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
                penjurian.config.tabIndex = 1;
                penjurian.config.tabPendukung.removeClass('done').removeClass('active');
                penjurian.config.tabNaratif.addClass('done').addClass('active');
                penjurian.config.btnBefore.attr({disabled:'disabled'});
                break;
            case 3:
                penjurian.config.tabIndex = 2;
                penjurian.config.tabFile.removeClass('done').removeClass('active');
                penjurian.config.tabPendukung.addClass('done').addClass('active');
                penjurian.config.btnNext.text('Selanjutnya');
                break;
        }
    },
    stepCertainTab: function(tabName){
        switch(tabName){
            case 'naratif':
                penjurian.config.tabNaratif.addClass('done').addClass('active');
                penjurian.config.tabPendukung.removeClass('done').removeClass('active');
                penjurian.config.tabFile.removeClass('done').removeClass('active');
                penjurian.config.formNaratif.css({display:'block'});
                penjurian.config.formPendukung.css({display:'none'});
                penjurian.config.formFile.css({display:'none'});
                break;
            case 'dataPendukung':
                penjurian.config.tabPendukung.addClass('done').addClass('active');
                penjurian.config.tabFile.removeClass('done').removeClass('active');
                penjurian.config.tabNaratif.removeClass('done').removeClass('active');
                penjurian.config.formNaratif.css({display:'none'});
                penjurian.config.formPendukung.css({display:'block'});
                penjurian.config.formFile.css({display:'none'});
                break;
            case 'file':
                penjurian.config.tabFile.addClass('done').addClass('active');
                penjurian.config.tabPendukung.removeClass('done').removeClass('active');
                penjurian.config.tabNaratif.removeClass('done').removeClass('active');
                penjurian.config.formNaratif.css({display:'none'});
                penjurian.config.formPendukung.css({display:'none'});
                penjurian.config.formFile.css({display:'block'});
                break;
        }
    },
    save: function(){

    }

};

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        penjurian.init({});
    });
}

$('#btnNext').on('click',function(){
    var text = penjurian.config.btnNext.text();
    switch (text){
        case 'Simpan':
            penjurian.save();
            break;
        default:
            penjurian.stepForward(penjurian.config.tabIndex);
            break;
    }
});

$('#btnBefore').on('click',function(){
    penjurian.stepBackward(penjurian.config.tabIndex);
});

$('#stepDataPendukung').on('click',function(){
    penjurian.stepCertainTab('dataPendukung');
});

$('#stepNaratif').on('click',function(){
    penjurian.stepCertainTab('naratif');
});

$('#stepFile').on('click',function(){
    penjurian.stepCertainTab('file');
});