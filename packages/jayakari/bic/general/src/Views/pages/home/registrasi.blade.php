@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/css/registrasi.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/css/login.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="javascript:;">General</a></li>
                <li><a href="http://bic.web.id">Utama</a></li>
                <li class="active">Registrasi Inovator</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <div class="content-page">
                        <div class="row">
                            <!-- BEGIN LEFT SIDEBAR -->
                            <div class="col-md-9 col-sm-9 blog-item">
                                <div class="post-comment">
                                    <h2>Registrasi Inovator</h2>
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Email<span class="color-red">*</span></label>
                                            <input class="form-control" type="text" id="email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Password<span class="color-red">*</span></label>
                                            <input class="form-control" type="password" id="password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Retype Password<span class="color-red">*</span></label>
                                            <input class="form-control" type="password" id="retype" name="retype">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama<span class="color-red">*</span></label>
                                            <input class="form-control" type="text" id="name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin<span class="color-red">*</span></label>
                                            <select id="selJK" name="selJK" class="form-control">
                                                <option value="Pria">Pria</option>
                                                <option value="Wanita">Wanita</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>HP<span class="color-red">*</span></label>
                                            <input class="form-control" type="text" id="hp" name="hp">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" type="text" rows="6" id="alamat" name="alamat"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>{{$labels["TAR"]}}<span class="color-red">*</span></label>
                                            <textarea class="form-control" type="text" rows="6" id="alasan" name="alasan"></textarea>
                                            <span class="help-block"><p style="text-align: justify;color: red;">{{$labels["PAR"]}}</p> </span>
                                        </div>
                                        <!--<p><button class="btn btn-primary" type="button" id="registrasi" name="registrasi">Registrasi</button></p>-->
                                        <div class="form-group">
                                            <div class="padding-left-0 padding-top-20 inline" style="margin-right:5px;">
                                                <button type="button" class="btn btn-primary" id="registrasi" name="registrasi"><i class="fa fa-key"></i> Registrasi</button>
                                            </div>
                                            <div class="padding-left-0 padding-top-20 inline" style="margin-right:5px;">
                                                <button type="button" class="btn btn-success" id="batal" name="batal"><i class="fa fa-close"></i> Batal</button>
                                            </div>
                                            <div class="padding-left-0 padding-top-20 inline">
                                                <button type="button" class="btn btn-info" id="utama" name="utama"><i class="fa fa-backward"></i> Awal</button>
                                            </div>
                                            <!--<div class="padding-left-0 padding-top-20 inline" style="margin-right:5px;">
                                                <button type="button" class="btn btn-success" id="manual" name="manual"><i class="fa fa-eye"></i>Read Manual</button>
                                            </div>
                                            <div class="padding-left-0 padding-top-20 inline">
                                                <button type="button" class="btn btn-info" id="diagram" name="diagram"><i class="fa fa-file-powerpoint-o"></i> Diagram</button>
                                            </div>-->
                                            <br class="clearBoth"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END LEFT SIDEBAR -->

                            <!-- BEGIN RIGHT SIDEBAR -->
                            <!--<div class="col-md-3 col-sm-3 blog-sidebar">
                                <h2 class="no-top-space">Kategori Berita</h2>
                                <ul class="nav sidebar-categories margin-bottom-40">
                                    <li><a href="javascript:;">Utama (18)</a></li>
                                    <li><a href="javascript:;">Inovasi (5)</a></li>
                                    <li><a href="javascript:;">Teknologi (7)</a></li>
                                    <li><a href="javascript:;">Serba Serbi (3)</a></li>
                                </ul>

                                <h2>Berita Terbaru</h2>
                                <div class="recent-news margin-bottom-10">
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-3">
                                            <img class="img-responsive" alt="" src="/<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/people/Hariyanto-Salim.jpg">
                                        </div>
                                        <div class="col-md-9 recent-news-inner">
                                            <h3><a href="javascript:;">Entrepreneurship Bootcamps Hari ke 4 : Dua Jawara Entrepreneurship Indonesia Hadir untuk Berbagi</a></h3>
                                            <p>Ini dia berita dari enterpreneurship bootcamps hari ke 4</p>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-3">
                                            <img class="img-responsive" alt="" src="/<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/people/Hariyanto-Salim.jpg">
                                        </div>
                                        <div class="col-md-9 recent-news-inner">
                                            <h3><a href="javascript:;">Entrepreneurship Bootcamp : Business Idea for Development 2.0</a></h3>
                                            <p>Ini dia berita dari enterpreneurship bootcamps</p>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-3">
                                            <img class="img-responsive" alt="" src="/<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/people/Hariyanto-Salim.jpg">
                                        </div>
                                        <div class="col-md-9 recent-news-inner">
                                            <h3><a href="javascript:;">Workshop : “How to Accelerate Public Private Partnership in Research” FK UI</a></h3>
                                            <p>Ini berita dari Workshop : “How to Accelerate Public Private Partnership in Research” FK UI</p>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <!-- END RIGHT SIDEBAR -->
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
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/registrasi.js" type="text/javascript"></script>
@stop