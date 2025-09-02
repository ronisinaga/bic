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
                                    <h2>{{$labels["TTR"]}}</h2><hr>
                                    <!--<h4>Terimakasih telah bergabung bersama BIC. Silahkan login dengan mengklik menu login diatas dan mulai untuk mengirimkan proposal anda. Kami tunggu proposal anda.</h4>
                                    <p style="text-align: justify">Mari bersama membangun bangsa dengan menghasilkan teknologi tepat guna dan tepat sasaran.</p>-->
                                    <?php echo $labels["PTR"]; ?><br>
                                    <a href="<?php echo env('URL_APP'); ?>" class="btn red">
                                        <i class="fa fa-refresh"></i> Kembali ke halaman awal </a>
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
                                            <img class="img-responsive" alt="" src="/bic_new/public/jayakari/bic/regular/pages/img/people/Hariyanto-Salim.jpg">
                                        </div>
                                        <div class="col-md-9 recent-news-inner">
                                            <h3><a href="javascript:;">Entrepreneurship Bootcamps Hari ke 4 : Dua Jawara Entrepreneurship Indonesia Hadir untuk Berbagi</a></h3>
                                            <p>Ini dia berita dari enterpreneurship bootcamps hari ke 4</p>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-3">
                                            <img class="img-responsive" alt="" src="/bic_new/public/jayakari/bic/regular/pages/img/people/Hariyanto-Salim.jpg">
                                        </div>
                                        <div class="col-md-9 recent-news-inner">
                                            <h3><a href="javascript:;">Entrepreneurship Bootcamp : Business Idea for Development 2.0</a></h3>
                                            <p>Ini dia berita dari enterpreneurship bootcamps</p>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-3">
                                            <img class="img-responsive" alt="" src="/bic_new/public/jayakari/bic/regular/pages/img/people/Hariyanto-Salim.jpg">
                                        </div>
                                        <div class="col-md-9 recent-news-inner">
                                            <h3><a href="javascript:;">Workshop : “How to Accelerate Public Private Partnership in Research” FK UI</a></h3>
                                            <p>Ini berita dari Workshop : “How to Accelerate Public Private Partnership in Research” FK UI</p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/general/pages/home/scripts/registrasi.js" type="text/javascript"></script>
@stop