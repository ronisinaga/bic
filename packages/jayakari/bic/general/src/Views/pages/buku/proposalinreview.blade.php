@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/index.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/portfolio.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="javascript:;">Inovasi</a></li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <?php
                        $strurl = $isibuku->judul_singkat;
                        $strurl = str_replace('+','~',$strurl);
                        ?>
                        <!--<a href="{{route('buku.inreview',['judul'=>urlencode($strurl)])}}" class="btn btn-primary"><i class="fa fa-eye"></i> Kembali ke buku</a>-->
                    </div>
                </div>
            </div><br>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <img src="{{asset('public/storage/icon/header_proposal.jpg')}}"/><br><br>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="pull-right">
                        <h1><b>Kandidat: <label style="color: red">{{$isibuku->orders or $isibuku->id_proposal.'-'}}</label></b></h1>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="content-page">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 blog-posts">
                                <h3><b>{{$proposal->judul}}</b></h3>
                            </div>
                        </div>
                        <hr class="blog-post-sep">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 blog-posts">
                                <h5><b>Abstrak</b></h5>
                                <hr>
                                <?php echo $proposal->abstrak; ?>
                            </div>
                        </div>
                        <hr class="blog-post-sep">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 blog-posts">
                                <h5><b>Deskripsi</b></h5>
                                <hr>
                                <?php echo $proposal->deskripsi; ?>
                            </div>
                        </div>
                        <hr class="blog-post-sep">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 blog-posts">
                                <h5><b>Keunggulan Teknologi</b></h5>
                                <hr>
                                <?php echo $proposal->keunggulan_teknologi; ?>
                            </div>
                        </div>
                        <hr class="blog-post-sep">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 blog-posts">
                                <h5><b>Potensi Aplikasi</b></h5>
                                <hr>
                                <?php echo $proposal->potensi_aplikasi; ?>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/scripts/view.js" type="text/javascript"></script>
@stop