/**
 * Created by alienware on 1/4/2018.
 */

var home = {
    config: {

    },
    init: function(settings){
        $.extend(home.config,settings);
        home.setup();
    },
    setup: function(){

    },

    redirectToPage : function(page){
        window.location = page;
    }
};

jQuery(document).ready(function() {

    $('#video').magnificPopup({
        delegate:'a',
        type:'iframe'
    });

    $("#DateCountdown").TimeCircles();
    //$("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false } }});
    //$("#PageOpenTimer").TimeCircles();
});

$('#a_pangan').on('mouseenter',function(){
    $('#pangan').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/1-pangan-c.png');
});

$('#a_pangan').on('mouseleave',function(){
    $('#pangan').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/1-pangan-b.png');
});

$('#a_pangan').on('click',function(){
    home.redirectToPage(host+'/general/kategori/pangan')
});

$('#a_energi').on('mouseenter',function(){
    $('#energi').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/2-energi-c.png');
});

$('#a_energi').on('mouseleave',function(){
    $('#energi').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/2-energi-b.png');
});

$('#a_energi').on('click',function(){
    home.redirectToPage(host+'/general/kategori/energi')
});

$('#a_transport').on('mouseenter',function(){
    $('#transport').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/3-transport-c.png');
});

$('#a_transport').on('mouseleave',function(){
    $('#transport').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/3-transport-b.png');
});
$('#a_transport').on('click',function(){
    home.redirectToPage(host+'/general/kategori/transport')
});

$('#a_tik').on('click',function(){
    home.redirectToPage(host+'/general/kategori/tik')
});

$('#a_tik').on('mouseenter',function(){
    $('#tik').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/4-tik-c.png');
});

$('#a_tik').on('mouseleave',function(){
    $('#tik').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/4-tik-b.png');
});

$('#a_tik').on('click',function(){
    home.redirectToPage(host+'/general/kategori/tik')
});

$('#a_hankam').on('mouseenter',function(){
    $('#hankam').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/5-hankam-c.png');
});

$('#a_hankam').on('mouseleave',function(){
    $('#hankam').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/5-hankam-b.png');
});

$('#a_hankam').on('click',function(){
    home.redirectToPage(host+'/general/kategori/hankam')
});

$('#a_kesehatan').on('mouseenter',function(){
    $('#kesehatan').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/6-kesehatan-c.png');
});

$('#a_kesehatan').on('mouseleave',function(){
    $('#kesehatan').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/6-kesehatan-b.png');
});

$('#a_kesehatan').on('click',function(){
    home.redirectToPage(host+'/general/kategori/kesehatan')
});

$('#a_material').on('mouseenter',function(){
    $('#material').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/7-material-c.png');
});

$('#a_material').on('mouseleave',function(){
    $('#material').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/7-material-b.png');
});

$('#a_material').on('click',function(){
    home.redirectToPage(host+'/general/kategori/material')
});

$('#a_lainnya').on('mouseenter',function(){
    $('#lainnya').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/8-lainnya-c.png');
});

$('#a_lainnya').on('mouseleave',function(){
    $('#lainnya').attr('src',host+'/public/jayakari/bic/regular/pages/img/icons/8-lainnya-b.png');
});

$('#a_lainnya').on('click',function(){
    home.redirectToPage(host+'/general/kategori/lainnya')
});
