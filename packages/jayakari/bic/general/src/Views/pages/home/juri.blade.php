@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/css/loading.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="main">
        <div class="modal"></div>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="javascript:;">General</a></li>
                <li><a href="<?php echo env('APP_URL'); ?>/general/login">Home</a></li>
                <li class="active">Menu Juri</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Menu Juri</h1>
                    <label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/manual/juri/1">1. Dashboard Juri </a></label><hr>
                    <label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/manual/juri/2">2. Juri </a></label><hr>
                    <label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/manual/juri/3">3. Penilaian </a></label><hr>
                    <label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/manual/juri/4">4. History Penilaian </a></label><hr>
                </div>
                <!-- END CONTENT -->
            </div>
            <div class="row">
                <a href="<?php echo env('APP_URL'); ?>/general/manual" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/actions.js" type="text/javascript"></script>
@stop