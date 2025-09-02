@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/index.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/portfolio.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <!-- BEGIN SLIDER -->
    <div class="main">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/scripts/index.js" type="text/javascript"></script>
@stop