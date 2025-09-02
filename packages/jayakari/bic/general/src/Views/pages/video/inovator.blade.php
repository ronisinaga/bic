@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/index.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/portfolio.css" rel="stylesheet" type="text/css" />
    <style>

        .module-box {
            display: inline-block;
            position: relative;
            width: 100%;
        }

        .module-dummy {
            margin-top: 100%;
        }

        .module-body {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .play-button-div {
            margin: 0 auto;
            tex-align: center;
            position: relative;
            display: inline-block;
        }

        .play-button-div:before {
            content: "\f01d";
            font-family: FontAwesome;
            font-size: 40px;
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
    <!-- BEGIN SLIDER -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table data-paging="false" data-searching="false" data-ordering="false" class="table table-striped table-bordered table-hover" id="allnews">
                        <thead>
                        <tr>
                            <th>Video</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $item)
                            <tr>
                                <td style="width: 100px">
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
                                    <div class="row">
                                        <div class="col-md-2 col- col-xs-12 col-sm-12">
                                            <a class="popup-youtube" href="{{$item->url_youtube}}">
                                                <div class="play-button-div">
                                                    <img src="http://img.youtube.com/vi/{{$videoid}}/hqdefault.jpg" height="100px" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-10 col-xs-12 col-sm-12">
                                            <h4 class="margin-bottom-10"><b>{{$item->title}}</b></h4>
                                            <a href="{{env('APP_URL')}}/general/inovator/{{$item->innovator->nickname}}"><h5 class="margin-bottom-10"><b>{{$item->innovator->fullname}}</b></h5></a>
                                            <?php $isi = substr(strip_tags($item->keterangan),0,500); ?>
                                            <p>{{$isi}}...</p>
                                            <?php
                                            $encode = urlencode($item->title);
                                            ?>
                                            <p><a class="more" href="<?php echo env('APP_URL'); ?>/inovator/video/{{$encode}}">Read more <i class="icon-angle-right"></i></a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/blog/scripts/index.js" type="text/javascript"></script>
@stop