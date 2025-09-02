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
                <li class="active">Profile Inovator</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Profile Inovator</h1>
                    <p style="text-align: justify;font-size: 14px;">Menu Inovator terdiri dari 1 sub menu yaitu sub menu profile seperti yang terlihat pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/menu_profile_inovator.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Setelah menu profile di klik akan muncul tampilan seperti pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tampilan_profile_inovator.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Tampilan profile inovator dibagi atas 2 bagian besar :</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;">Tampilan avatar inovator</p>
                            <p style="text-align: justify;font-size: 14px;">Tampilan avatar inovator adalah foto dari inovator. Secara default sistem akan menampilkan gambar seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/avatar_inovator.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;">Profile Account</p>
                            <p style="text-align: justify;font-size: 14px;">Profile account berisikan informasi detail dari inovator seperti yang dijelaskan dibawah ini:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Personal Info</b></p>
                            <p style="text-align: justify;font-size: 14px;">Personal info berisikan informasi personal dari inovator, mulai dari Nama, Jenis Kelamin, Telp/HP, Email dan sebagainya seperti yang terlihat
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/personal_info_inovator.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Ubah Avatar</b></p>
                            <p style="text-align: justify;font-size: 14px;">Fitur ubah avatar memungkinkan inovator untuk merubah foto/avatar dari inovator. tampilan dari fitur ubah avatar adalah
                                seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/ubah_avatar_inovator.png"/>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Ubah Password</b></p>
                            <p style="text-align: justify;font-size: 14px;">Fitur ubah password memungkinkan inovator untuk mengubah password sesuai dengan yang dikehendaki. tampilan dari fitur
                                ubah password ini adalah seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/ubah_password_inovator.png"/>
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