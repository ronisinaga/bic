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
                <li class="active">Dashboard Inovator</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Dashboard Inovator</h1>
                    <p style="text-align: justify;font-size: 14px;">Tampilan dashboard inovator adalah seperti pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/dashboard_inovator.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Dashboard Inovator adalah menu yang merepresentasikan fitur dashboard untuk inovator. Fitur ini akan menampilkan 2 informasi utama,yaitu seperti yang dijelaskan pada penjelasan dibawah ini:</p>
                        <ul>
                            <li>
                                <p style="text-align: justify;font-size: 14px;">Ucapan Selamat Datang</p>
                                <p style="text-align: justify;font-size: 14px;">Ucapan selamat datang yang disertai dengan petunjuk cara penggunaan fitur-fitur untuk inovator, seperti yang terlihat pada gambar dibawah ini:</p>
                                <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/dashboard_inovator_welcome.png"/>
                            </li>
                            <li>
                                <p style="text-align: justify;font-size: 14px;">Fitur Shortcut</p>
                                <p style="text-align: justify;font-size: 14px;">Fitur shortcut ini memudahkan inovator untuk mengakses data tanpa harus mengklik menu yang ada disebelah kiri. ada 2 shortcut pada dashboard inovator yaitu:</p>
                                <p style="text-align: justify;font-size: 14px;"><b>1. Message dari Reviewer</b></p>
                                <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan inovator untuk melihat pesan-pesan yang dikirimkan oleh reviewer. Pesan ini berupa komentar
                                yang mungkin disampaikan oleh reviewer terkait dengan proposal yang kita kirimkan. Shortcut ini hanya menampilkan 5 data pesan terbaru. Contoh tampilannya adalah
                                seperti yang terlihat pada gambar dibawah ini:</p>
                                <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/dashboard_inovator_message_reviewer.png"/><br><br>
                                <p style="text-align: justify;font-size: 14px;"><b>2. Proposal Terbaru</b></p>
                                <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan inovator untuk melihat proposal-proposal yang dibuat oleh inovator. pada shortcut ini, inovator
                                    akan melihat 5 proposal terbaru yang dibuat oleh inovator. Contoh tampilannya adalah seperti yang terlihat pada gambar dibawah ini:</p>
                                <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/dashboard_inovator_proposal_terbaru.png"/>
                            </li>
                        </ul>
                </div>
                <!-- END CONTENT -->
            </div>
            <div class="row">
                <a href="<?php echo env('APP_URL'); ?>/general/manual/inovator" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
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