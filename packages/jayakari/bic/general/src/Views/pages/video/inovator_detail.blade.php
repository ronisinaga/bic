@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <style>
        .play-button-div {
            margin: 0 auto;
            tex-align: center;
            position: relative;
            display: inline-block;
        }

        .play-button-div:before {
            content: "\f01d";
            font-family: FontAwesome;
            font-size: 200px;
            padding: .05em .2em;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 99;
        }

        .play-button-div img {
            transition: opacity ease .5s;
        }

        .play-button-div:hover img {
            opacity: .6;
        }
    </style>
@stop
@section('content')
    <div class="processing"></div>
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('general.kristanto')}}">Video Kisah Sukses Inovator</a></li>
                <li class="active">{{$videos->title}}</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <input type="hidden" id="id" name="id" value="{{$videos->id}}"/>
                    <input type="hidden" id="judul" name="judul" value="{{$videos->title}}"/>
                    <h1 style="padding-left: 5px">{{$videos->title}}</h1><br><br>
                    <div class="content-page" style="padding-left: 10px">
                        <div class="row">
                            <!-- BEGIN LEFT SIDEBAR -->
                            <div class="col-md-9 col-sm-9 blog-item">
                                <?php
                                    $videoid = '';
                                    $haystack = $videos->url_youtube;
                                    $needle = 'watch';
                                    if (strpos($haystack, $needle) !== false){
                                        //found
                                        $url = explode('=',$videos->url_youtube);
                                        if (count($url) > 0){
                                            $videoid = $url[count($url)-1];
                                        }
                                    }else{
                                        //not found
                                        $url = explode('/',$videos>url_youtube);
                                        if (count($url) > 0){
                                            $videoid = $url[count($url)-1];
                                        }
                                    }
                                ?>
                                <div  style="text-align: center">
                                    <a class="popup-youtube" href="{{$videos->url_youtube}}">
                                        <div class="play-button-div">
                                            <img src="http://img.youtube.com/vi/{{$videoid}}/hqdefault.jpg" class="img-responsive" />
                                        </div>
                                    </a>
                                </div><br><br>
                                 <?php echo $videos->keterangan; ?>
                            </div>
                            <!-- END LEFT SIDEBAR -->

                            <!-- BEGIN RIGHT SIDEBAR -->
                            <div class="col-md-3 col-sm-3 blog-sidebar">
                                <h2>Kisah Sukses Terbaru</h2>
                                <div class="recent-blog margin-bottom-10">
                                    @foreach($latestVideo as $item)
                                        <?php
                                        $videoid = '';
                                        $haystack = $item->url_youtube;
                                        $needle = 'watch';
                                        if (strpos($haystack, $needle) !== false){
                                            //found
                                            $url = explode('=',$item->url_youtube);
                                            if (count($url) > 0){
                                                $videoid = $url[count($url)-1];
                                            }
                                        }else{
                                            //not found
                                            $url = explode('/',$item->url_youtube);
                                            if (count($url) > 0){
                                                $videoid = $url[count($url)-1];
                                            }
                                        }
                                        ?>
                                        <div class="row margin-bottom-10">
                                            <div class="col-md-3">
                                                <img src="http://img.youtube.com/vi/{{$videoid}}/hqdefault.jpg" class="img-responsive" />
                                            </div>
                                            <div class="col-md-9 recent-blog-inner">
                                                <?php
                                                    $encode = urlencode($item->title);
                                                ?>
                                                <p><a class="more" href="<?php echo env('APP_URL'); ?>/inovator/video/{{$encode}}">{{$item->title}}</a></p>
                                                <?php $isi = substr(strip_tags($item->content),0,100); ?>
                                                <?php echo $isi; ?>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- END RECENT NEWS -->
                            </div>
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
        $(document).ready(function() {
            $('.popup-youtube').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        });
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/regular/pages/blog/scripts/show.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop