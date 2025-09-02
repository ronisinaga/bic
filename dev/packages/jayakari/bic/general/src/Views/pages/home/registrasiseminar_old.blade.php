@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/css/registrasiseminar.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/css/login.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="javascript:;">General</a></li>
                <li><a href="http://bic.web.id">Utama</a></li>
                <li class="active">Registrasi Seminar Inovasi</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <div class="content-page">
                        <div class="row">
                            <!-- BEGIN LEFT SIDEBAR -->
                            <div class="col-md-12 col-sm-12 blog-item">
                                <div class="post-comment">
                                    <div style="text-align: center">
                                        <h3>Formulir Pendaftaran</h3>
                                        <h2><b>ACCELERATING INDONESIA'S INNOVATION:</b></h2>
                                        <h2>FROM PARADIGM TO ACTION!</h2>
                                        <h4>11,13-14 Desember 2018, Kempinski Hotel, Jakarta Pusat</h4>
                                    </div><hr>
                                    <div style="text-align: center">
                                        <h4>Informasi Pendaftaran:</h4>
                                        <h4><b>Business Innovation Center (BIC)</b></h4>
                                        <h4>PQM Building, Ground Floor, Jl. Cempaka Putih Tengah 17C No. 7A</h4>
                                        <h4>Cempaka Putih - Jakarta Pusat 10510</h4>
                                        <h4>Phone: (021) 4288 5430, Fax: (021) 21472655</h4>
                                    </div><hr>
                                    <div class="alert alert-danger" id="error" name="error" style="display: none">

                                    </div><br>
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b>Ya</b> mohon didaftarkan mengikuti
                                            </div>
                                            <div class="col-md-3">
                                                <input type="checkbox" id="seminar" name="seminar"> Seminar, 11 Des 2018
                                            </div>
                                            <div class="col-md-3">
                                                <input type="checkbox" id="workshop" name="workshop"> Workshop, 13-14 Des 2018
                                            </div>
                                            <div class="col-md-3">
                                                <input type="checkbox" id="both" name="both"> Keduanya
                                            </div>
                                        </div><br>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <label>Nama Lengkap<span class="color-red">*</span></label>
                                                    <input class="form-control" type="text" id="name" name="name">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Jenis Kelamin<span class="color-red">*</span></label>
                                                    <select class="form-control" id="selJK" name="selJK">
                                                        <option value="">Jenis Kelamin</option>
                                                        <option value="Pria">Pria</option>
                                                        <option value="Wanita">Wanita</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan<span class="color-red">*</span></label>
                                            <input class="form-control" type="text" id="jabatan" name="jabatan">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Perusahaan<span class="color-red">*</span></label>
                                            <input class="form-control" type="text" id="perusahaan" name="perusahaan">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Perusahaan/Organisasi:<span class="color-red">*</span></label>
                                            <textarea class="form-control" type="text" rows="6" id="alamat" name="alamat"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon/HP untuk konfirmasi pendaftaran:<span class="color-red">*</span></label>
                                            <input class="form-control" type="text" id="telp" name="telp">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat e-mail untuk konfirmasi pendaftaran:<span class="color-red">*</span></label>
                                            <input class="form-control" type="text" id="email" name="email">
                                        </div>
                                        <!--<p><button class="btn btn-primary" type="button" id="registrasi" name="registrasi">Registrasi</button></p>-->
                                        <div class="form-group">
                                            <div class="padding-left-0 padding-top-20 inline" style="margin-right:5px;">
                                                <button type="button" class="btn btn-primary" id="registrasi" name="registrasi"><i class="fa fa-key"></i> Registrasi</button>
                                            </div>
                                            <div class="padding-left-0 padding-top-20 inline">
                                                <button type="button" class="btn btn-info" id="utama" name="utama"><i class="fa fa-backward"></i> Home</button>
                                            </div>
                                            <!--<div class="padding-left-0 padding-top-20 inline" style="margin-right:5px;">
                                                <button type="button" class="btn btn-success" id="manual" name="manual"><i class="fa fa-eye"></i>Read Manual</button>
                                            </div>
                                            <div class="padding-left-0 padding-top-20 inline">
                                                <button type="button" class="btn btn-info" id="diagram" name="diagram"><i class="fa fa-file-powerpoint-o"></i> Diagram</button>
                                            </div>-->
                                            <br class="clearBoth"/>
                                        </div><br>
                                        <div class="alert alert-danger" id="errorBawah" name="errorBawah" style="display: none">

                                        </div><hr>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p><b>Registrasi dan Cara Pembayaran:</b><br>
                                                <b>Biaya Seminar:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp. 2.500.000</br>
                                                <b>Biaya Workshop:</b>&nbsp;&nbsp;&nbsp;&nbsp;Rp. 7.500.000</p><br>
                                                <p>Pembayaran melalui transfer Bank ke:<br>
                                                Nomor Rekening: 118 501 000 107 302<br>
                                                a/n: Business Innovation Center<br>
                                                <b>Bank BRI Cabang Muncul Serpong</b></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@stop
@section('footer_page')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = "<?php echo env('APP_URL'); ?>";
        var save = "<?php echo route('registrasi.seminar.save') ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/registrasiseminar.js" type="text/javascript"></script>
@stop