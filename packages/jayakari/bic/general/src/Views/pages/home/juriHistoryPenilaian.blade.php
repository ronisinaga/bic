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
                <li class="active">History Penilaian Juri</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>History Penilaian Juri</h1>
                    <p style="text-align: justify;font-size: 14px;">Menu History Penilaian terdiri dari 2 sub menu yaitu sub menu profile seperti yang terlihat pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_history_penilaian.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Untuk lebi jelasnya mengenai kedua menu tersebut,dapat dilihat pada penjelasan dibawah ini:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Active Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu active batch di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_history_penilaian_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pada bagian ini akan muncul seluruh proposal-proposal yang dinilai oleh juri yang masuk dalam batch yang aktif. Untuk melihat
                                penilaian yang telah/belum dilakukan oleh dewan juri maka dapat dilakukan dengan mengklik judul proposal. Setelah di klik maka akan muncul
                                tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_history_penilaian_2.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>History Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu history batch di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_history_penilaian_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pada bagian ini akan muncul seluruh proposal-proposal yang dinilai oleh juri yang masuk dalam batch yang aktif. Untuk melihat
                                penilaian yang telah/belum dilakukan oleh dewan juri maka dapat dilakukan dengan mengklik judul proposal. Setelah di klik maka akan muncul
                                tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_history_penilaian_2.png"/><br><br>
                        </li>
                    </ul>
                </div>
                <!-- END CONTENT -->
            </div>
            <div class="row">
                <a href="<?php echo env('APP_URL'); ?>/general/manual/juri" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
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