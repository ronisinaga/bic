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
                <li><a href="javascript:;">Rumah Inovasi</a></li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h2>Rumah Inovasi </h2><hr>
                    @foreach($buku as $item)
                        <div class="content-page">
                            <div class="row margin-bottom-30">
                                <!-- BEGIN CAROUSEL -->
                                <div class="col-md-5 front-carousel">
                                    <div class="carousel slide" id="myCarousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <?php $index = 0; ?>
                                            @foreach($item->file as $data)
                                                <?php
                                                    $files = explode('.',$data->path);
                                                    if ($files[1] == 'jpg' || $files[1] == 'JPG'|| $files[1] == 'jpeg' || $files[1] == 'JPEG' || $files[1] == 'gif' || $files[1] == 'GIF' || $files[1] == 'png' || $files[1] == 'PNG' || $files[1] == 'bmp' || $files[1] == 'BMP'){
                                                        if ($index == 0){
                                                            echo '<div class="item active">';
                                                        }else{
                                                            echo '<div class="item">';
                                                        }
                                                        $arrpath = explode('.',$data->path);
                                                        $path = '';
                                                        switch ($arrpath[1]){
                                                            case 'pdf':
                                                                $path = '/public/storage/buku/pdf.png';
                                                                break;
                                                            case 'doc':
                                                                $path = '/public/storage/buku/word.png';
                                                                break;
                                                            case 'docx':
                                                                $path = '/public/storage/buku/word.png';
                                                                break;
                                                            default:
                                                                $path = '/public/storage/'.$data->path;
                                                                break;
                                                        }
                                                        echo '<img alt="" src="'.env('APP_URL').$path.'">';
                                                        echo '<div class="carousel-caption">';
                                                        echo '<p>'.$item->judul_singkat.'</p>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        $index++;
                                                    }
                                                ?>
                                            @endforeach
                                            <!--<div class="item">
                                                <img alt="" src="{{env('APP_URL')}}/public/jayakari/bic/regular/pages/img/img_100-187.JPG">
                                                <div class="carousel-caption">
                                                    <p>Keterangan Kedua</p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <img alt="" src="{{env('APP_URL')}}/public/jayakari/bic/regular/pages/img/img_100-188.JPG">
                                                <div class="carousel-caption">
                                                    <p>Keterangan Ketiga</p>
                                                </div>
                                            </div>-->
                                        </div>
                                        <!-- Carousel nav -->
                                        <a data-slide="prev" href="#myCarousel" class="carousel-control left">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                        <a data-slide="next" href="#myCarousel" class="carousel-control right">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- END CAROUSEL -->

                                <!-- BEGIN PORTFOLIO DESCRIPTION -->
                                <div class="col-md-7">
                                    <h2>{{$item->judul_singkat}}</h2>
                                    <p>Pemenang Inovasi {{$item->buku->judul}}</p>
                                    <br>

                                    <a class="btn btn-primary" href="{{url('/general/view/'.$item->judul_singkat)}}"><span style="color: #fff"><i class="fa fa-eye"></i> LIHAT DETAIL</span></a>
                                </div>
                                <!-- END PORTFOLIO DESCRIPTION -->
                            </div>
                        </div><hr>
                    @endforeach
                </div>
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