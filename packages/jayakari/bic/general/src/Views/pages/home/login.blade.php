@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/css/login.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="main">
        <div class="processing"></div>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="javascript:;">General </a></li>
                <li><a href="http://localhost/demo">Home</a></li>
                <li class="active">Login</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-6 col-sm-6">
                    <div class="row">
                        <div class="col-md-1">
                            <div>
                                <h1>Login </h1>
                                <!--<img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/demo.png"/>-->
                            </div>
                        </div>
                        <div class="col-md-11" style="margin-top: 43px;">
                            <form class="form-horizontal form-without-legend" role="form" id="frmAddUser" name="frmAddUser">
                                <div class="form-group">
                                    <label for="email" class="col-lg-4 control-label">Username (Email)<span class="require">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="username" name="username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control" id="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">
                                        <a href="javascript:;" id="forget" name="forget">Forget Password?</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-lg-4 control-label"></label>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-primary" id="login" name="login"><i class="fa fa-send"></i> Login</button>
                                    </div>
                                <!--<div class="padding-left-0 padding-top-20 inline" style="margin-right:5px;">
                                        <button type="button" class="btn btn-success" id="registrasi" name="registrasi"><i class="fa fa-key"></i> Registrasi</button>
                                    </div>
                                    <div class="padding-left-0 padding-top-20 inline">
                                        <button type="button" class="btn btn-info" id="utama" name="utama"><i class="fa fa-backward"></i> Awal</button>
                                    </div>-->
                                    <div class="col-lg-3">
                                        <button type="button" class="btn btn-success" id="manual" name="manual"><i class="fa fa-eye"></i>Read Manual</button>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-info" id="diagram" name="diagram"><i class="fa fa-file-powerpoint-o"></i> Diagram</button>
                                    </div>
                                    <br class="clearBoth"/>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">
                                        <p style="text-align: justify;font-size: 9px;font-style: italic">* Simpanlah baik-baik username (e-mail) dan   password Anda, karena itu satu-satunya akses ke proposal Anda di database BIC, hanya Anda yang tahu. Jika Anda mengalami kesulitan apapun, laporkan masalah Anda ke e-mail : info@bic.web.id</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--<h3>Keterangan:</h3>
                    <div class="content-form-page">
                        <div class="row">
                        <div class="col-md-12 padding-left-0 padding-top-20">
                        <ul>
                            <li style="text-allign:justify;font-size:14px;">Inovator peserta 100+ Inovasi Indonesia dapat tetap  menggunakan user ID dan passwordnya sendiri untuk mencoba melihat file inovasi mereka di sistem yang baru</li>
                            <li style="text-allign:justify;font-size:14px;">Bagi yang berminat untuk mencoba DEMO Sistem Informasi BIC, gunakan <b>userID:  inovator@email.com, dan password: inovator</b></li>
                            <li style="text-allign:justify;font-size:14px;">Untuk mempelajari <b>DEMO sistem informasi manajemen inovasi terlebih dahulu, silahkan klik : “Read Manual”</b> di atas</li>
                        </ul>
                        </div>
                        </div>
                    </div>-->
                </div>
                <div class="col-md-4 col-sm-4">
                    <!--<h3 style="text-align: center">Selamat Datang!<br> di pemilihan<br> <font color="red">112 Inovasi Indonesia - 2020</font></h3><hr>-->
                    <?php echo $labels["JLU"]; ?>
                    <?php echo $labels["TLU"]; ?>
                    <!--<p style="text-align: justify;color: blue">Bila Anda telah terdaftar sebagai inovator di database BIC, silakan “Login”, untuk merevisi proposal Anda, atau mengajukan proposal baru ke “Pemilihan 110 Inovasi Indonesia 2018”.</p>-->
                    <!--<p style="text-align: justify;">Jika Anda sudah terdaftar di pemilihan 100+ Inovasi Indonesia sebelumnya, silakan Anda “Login”, untuk merevisi proposal Anda, atau mengajukan proposal Anda yang baru.</p>
                    <font style="text-align: justify;">Jika ini pertama kalinya Anda ikut pemilihan, silakan klik menu <font color="red">LOGIN & REGISTRASI</font> lalu klik menu <font color="red">REGISTRASI</font></p>
                    <p style="text-align: justify;">Bila lupa <font color="red">“password”</font>  Anda, silakan gunakan fasilitas <font color="red">“Forget Password?”</font></p>
                    <p style="text-align: justify;">Untuk Panduan Sistem Database Inovasi BIC tekan “Read Manual” atau “Diagram”.</p> -->
                    <!--<img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/image_for_search.png"/>-->
                    <!--<h3>Username & Password</h3><hr>
                    <p style="text-align: justify">Untuk dapat menggunkan website demo ini, gunakan username dan password dibawah ini:</p>
                    <h4><b>Role sebagai Inovator</b></h4>
                    <p style="text-align: justify">Username: inovator1@email.com</p>
                    <p style="text-align: justify">Password: inovator1</p>
                    <h4><b>Role sebagai Reviewer</b></h4>
                    <p style="text-align: justify">Username: reviewer1@email.com</p>
                    <p style="text-align: justify">Password: reviewer1</p>
                    <h4><b>Role sebagai Admin Proses</b></h4>
                    <p style="text-align: justify">Username: proses1@email.com</p>
                    <p style="text-align: justify">Password: proses1</p>
                    <h4><b>Role sebagai Juri</b></h4>
                    <p style="text-align: justify">Username: juri1@email.com</p>
                    <p style="text-align: justify">Password: juri1</p>-->
                </div>
                <!-- END CONTENT -->
                <div class="col-md-2 col-sm-2">
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/email/{{$labels["LLU"]}}"/>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    <div class="modal fade" id="popupForgetPassword"tabindex="-1" name="popupForgetPassword" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Alamat Email</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3">Alamat Email Anda</label>
                            <div class="col-md-9">
                                <input type="text" id="popupEmail" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal">Tutup</button>
                    <button type="button" class="btn btn-success" id="send" name="send">Reset Password</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/actions.js" type="text/javascript"></script>
@stop