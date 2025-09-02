/**
 * Created by alienware on 6/6/2018.
 */
jQuery(document).ready(function() {

    $('.popup-video').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    })
});