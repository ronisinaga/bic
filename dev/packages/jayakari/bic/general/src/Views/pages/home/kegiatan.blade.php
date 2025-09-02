@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/<?php echo env('APP_URL'); ?>/assets/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="/<?php echo env('APP_URL'); ?>/assets/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print" />
    <!-- END PAGE LEVEL PLUGINS -->
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

    </style>
@stop
@section('content')
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="javascript:;">Kegiatan</a></li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-9">
                    <div id='calendar'></div>
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN RIGHT SIDEBAR -->
                <div class="col-md-3 col-sm-3 blog-sidebar">
                    <!-- CATEGORIES START -->
                    <h2 class="no-top-space">Kategori Berita</h2>
                    <ul class="nav sidebar-categories margin-bottom-40">
                        <li><a href="javascript:;">Utama (18)</a></li>
                        <li><a href="javascript:;">Inovasi (5)</a></li>
                        <li><a href="javascript:;">Teknologi (7)</a></li>
                        <li><a href="javascript:;">Serba Serbi (3)</a></li>
                    </ul>
                    <!-- CATEGORIES END -->

                    <!-- BEGIN RECENT NEWS -->
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
                    <!-- END RECENT NEWS -->
                </div>
                <!-- END RIGHT SIDEBAR -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@stop
@section('footer_page')
    <script src="/<?php echo env('APP_URL'); ?>/assets/fullcalendar/lib/moment.min.js" type="text/javascript"></script>
    <script src="/<?php echo env('APP_URL'); ?>/assets/fullcalendar/fullcalendar.js" type="text/javascript"></script>
    <script src="/<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/kegiatan/scripts/biccalendar.js" type="text/javascript"></script>
@stop