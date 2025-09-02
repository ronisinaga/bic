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
                <li class="active">Dashboard Juri</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Dashboard Juri</h1>
                    <p style="text-align: justify;font-size: 14px;">Tampilan dashboard juri adalah seperti pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_dashboard.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Dashboard juri adalah menu yang merepresentasikan fitur dashboard untuk admin proses. Fitur ini akan menampilkan 2 informasi utama,yaitu seperti yang dijelaskan pada penjelasan dibawah ini:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Resume Jumlah Proposal Berdasarkan status proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Resume Jumlah Proposal Berdasarkan status proposal merupakan tampilan yang menampilkan jumlah proposal pada masing-masing status proposal seperti
                                yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_dashboard_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pada masing-masing resume ada link yang nantinya akan menampilkan list proposal sesuai dengan jumlah yang ditampilkan pada resume. Ketika link diklik
                                maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_2.png"/>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail dari proposal tersebut maka klik judul proposal. Setelah judul proposal di klik maka akan muncul tampilan seperti pada gambar dibawah
                                ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_3.png"/>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Fitur Shortcut</b></p>
                            <p style="text-align: justify;font-size: 14px;">Fitur shortcut ini memudahkan juri untuk mengakses data tanpa harus mengklik menu yang ada disebelah kiri. ada 2 shortcut pada dashboard juri yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Proposal Belum Nilai</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan juri untuk melihat proposal-proposal mana saja yang belum dinilai oleh juri. Tampilan dari proposal belum nilai
                                adalah seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_dashboard_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail dari proposal ini dapat dilakukan dengan klik link text View. Setelah di klik maka akan muncul tampilan seperti
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_3.png"/>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal belum nilai ini maksimum berisikan 5 proposal.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Daftar Seluruh Proposal Yang Dinilai</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan juri untuk melihat seluruh proposal yang masuk dan proposal-proposal mana yang sudah diberi nilai oleh
                                juri dan mana yang belum, termasuk juga proposal-proposal dimana juri yang login memberikan penilaian. Tampilan dari shortcut ini dapat dilihat
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_dashboard_3.png"/><br><br>
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