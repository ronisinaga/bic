@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/general/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/general/pages/home/css/registrasi.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="main">
        <div class="modal"></div>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo env('APP_URL'); ?>">General</a></li>
                <li><a href="javascript:;">Utama</a></li>
                <li class="active">Kontak</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12">
                    <h1>Hubungi Kami</h1>
                    <div class="content-page">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="map" class="gmaps margin-bottom-40" style="height:400px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><i class="fa fa-building-o"></i> PQM Building, Ground Floor, Cempaka Putih Tengah 17C no. 7a, Jakarta 10510, Indonesia.</p>
                                <p><i class="fa fa-phone"></i> (+62) 21 4288 5430 (telp)</p>
                                <p><i class="fa fa-fax"></i> (+62) 21 2147 2655 (fax)</p>
                                <p><i class="fa fa-mobile"></i> (+62) 8118 242 558 (BIC-JKT)</p>
                                <p><i class="fa fa-mobile"></i> (+62) 8118 242 462 (BIC-INA)</p>
                                <p><i class="fa fa-envelope"></i> info@bic.web.id</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@stop
@section('footer_page')
    <script src="http://maps.google.com/maps/api/js?sensor=true&key=AIzaSyDEsXAiJX7kv3X1LzN2niYfRw-K1iM4cCg" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/gmaps/scripts/gmaps.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/about.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = "<?php echo env('APP_URL'); ?>";
        ContactUs.init();
    </script>
@stop