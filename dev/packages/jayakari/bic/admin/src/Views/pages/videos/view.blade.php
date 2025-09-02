@section('header_page')
<link href="<?php echo env('APP_URL'); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" media="all">
@stop
<div class="mfp-iframe-scaler">
    <div class="mfp-close"></div>
    <iframe class="mfp-iframe" src="//www.youtube.com/embed//{{$videoid}}" frameborder="0" allowfullscreen></iframe>
</div>
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
@stop