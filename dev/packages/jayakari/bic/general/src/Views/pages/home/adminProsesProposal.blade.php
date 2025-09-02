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
                <li class="active">Proposal Admin Proses</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Proposal Admin Proses</h1>
                    <p style="text-align: justify;font-size: 14px;">Menu Proposal terdiri dari 5 sub menu yaitu Proposal Sudah Review, Proposal Seleksi,
                        Proposal Disimpan, Proposal Diterima dan Proposal Ditolak seperti yang terlihat pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_profile_3.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Berikut penjelasan dari ke 5 sub menu tersebut:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Sudah Review</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Sudah Review di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada gambar
                                dibawah ini : </p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_5.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Seleksi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Seleksi di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_7.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal seleksi ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Disimpan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Disimpan di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_8.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal disimpan ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Diterima</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Diterima di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_9.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal diterima ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Ditolak</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Ditolak di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_10.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal ditolak ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                    </ul>
                </div>
                <!-- END CONTENT -->
            </div>
            <div class="row">
                <a href="<?php echo env('APP_URL'); ?>/general/manual/proses" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
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