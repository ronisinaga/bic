@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/css/manual.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" media="all">
@stop
@section('content')
    <div class="main">
        <div class="modal"></div>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="javascript:;">General</a></li>
                <li><a href="<?php echo env('APP_URL'); ?>/general/login">Home</a></li>
                <li class="active">Manual</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row">

                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-9">
                    <h1>Manual</h1>
                    <table class="table table-striped table-hover">
                        <tr>
                            <td width="175px"><label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/manual/inovator">1. Manual Inovator </a></label></td>
                            <td width="55px"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/arrow.png"/></td>
                            <td><label class="control-label">Panduan dan informasi tampilan layar bagi inovator yang mendaftarkan diri serta mengajukan proposal mereka  ke database inovasi BIC</label></td>
                        </tr>
                        <tr>
                            <td width="175px"><label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/manual/reviewer">2. Manual Reviewer </a></label></td>
                            <td width="55px"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/arrow.png"/></td>
                            <td><label class="control-label">Panduan dan informasi tampilan layar bagi pengelola proposal yang berkomunikasi dengan inovator pengaju proposal</label></td>
                        </tr>
                        <tr>
                            <td width="175px"><label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/manual/proses">3. Manual Admin Proses </a></label></td>
                            <td width="55px"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/arrow.png"/></td>
                            <td><label class="control-label">Panduan dan informasi tampilan layar bagi pengelola aplikasi sistem informasi manajemen inovasi BIC secara keseluruhan</label></td>
                        </tr>
                        <tr>
                            <td width="175px"><label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/manual/juri">4. Manual Juri </a></label></td>
                            <td width="55px"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/arrow.png"/></td>
                            <td><label class="control-label">Panduan dan informasi tampilan layar bagi para juri penilai proposal inovasi</label></td>
                        </tr>
                        <tr>
                            <td width="175px"><label for="email" class="control-label"><a href="<?php echo env('APP_URL'); ?>/general/viewVideo/sFtefDxIcZE" class="popup-video">5. Video Penjelasan Sistem BIC </a></label></td>
                            <td width="55px"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/arrow.png"/></td>
                            <td><label class="control-label">Video penjelasan proses-proses yang terjadi mulai dari registrasi inovator, upload proposal sampai dengan proses penjurian pada sistem informasi BIC</label></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3 col-sm-3">
                    <a href="<?php echo env('APP_URL'); ?>/general/diagram"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clickhere.png"/></a>
                    <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/hand3.png" style="margin-left:75px;margin-right: auto;display:block"/>
                    <p style="text-align: justify">
                        Click gambar di atas untuk melihat diagram keseluruhan Sistem Informasi Manajemen Inovasi BIC
                    </p>
                </div>
                <!-- END CONTENT -->
            </div>
            <div class="row">
                <a href="<?php echo env('APP_URL'); ?>/general/login" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php  echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/manual.js" type="text/javascript"></script>
@stop