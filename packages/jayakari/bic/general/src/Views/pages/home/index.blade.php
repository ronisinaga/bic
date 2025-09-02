@extends('jayakari.bic.general::layouts.new')
@section('header_page')
    <link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .carousel-wrap {
        width: 1000px;
        margin: auto;
        position: relative;
    }
    .owl-carousel .owl-nav{
        overflow: hidden;
        height: 0px;
    }

    .owl-theme .owl-dots .owl-dot.active span,
    .owl-theme .owl-dots .owl-dot:hover span {
        background: #2caae1;
    }


    .owl-carousel .item {
        text-align: center;
    }
    .owl-carousel .nav-btn{
        height: 47px;
        position: absolute;
        width: 26px;
        cursor: pointer;
        top: 100px !important;
    }

    .owl-carousel .owl-prev.disabled,
    .owl-carousel .owl-next.disabled{
        pointer-events: none;
        opacity: 0.2;
    }

    .owl-carousel .prev-slide{
        background: url({{env('APP_URL')}}/public/jayakari/bic/regular/img/nav-icon.png) no-repeat scroll 0 0;
        left: -33px;
    }
    .owl-carousel .next-slide{
        background: url({{env('APP_URL')}}/public/jayakari/bic/regular/img/nav-icon.png) no-repeat scroll -24px 0px;
        right: -33px;
    }
    .owl-carousel .prev-slide:hover{
        background-position: 0px -53px;
    }
    .owl-carousel .next-slide:hover{
        background-position: -24px -53px;
    }

    span.img-text {
        text-decoration: none;
        outline: none;
        transition: all 0.4s ease;
        -webkit-transition: all 0.4s ease;
        -moz-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        cursor: pointer;
        width: 100%;
        font-size: 20px;
        display: block;
        text-transform: capitalize;
    }
    span.img-text:hover {
        color: #2caae1;
    }

    .equal {
        display: flex;
        display: -webkit-flex;
        flex-wrap: wrap;
    }

    .imageParent {
        position:relative;
        text-align:center;
        overflow:hidden
    }

    .owl-carousel .fixed-video-aspect {
        position: relative;
    }
    .owl-carousel .fixed-video-aspect:before {
        display: block;
        content: "";
        height: 300px;
    }
    .owl-carousel .fixed-video-aspect > .item-video {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    @media (min-width: 320px) {
        .navbar-toggle {
            display: block;
        }

        .navbar-nav {
            display: none;
        }

        .img {
            max-width: 100%;
            height: auto;
            width: auto \9; /* ie8 */
        }
    }

    @media (min-width: 768px) and (max-width:12000px) {
        .navbar-toggle {
            display: block;
        }
        .navbar-nav {
            display: none;
        }

        .img {
            max-width: 100%;
            height: auto;
            width: auto\9; /* ie8 */
        }
    }

    @media (min-width: 1320px) {
        .navbar-toggle {
            display: none;
        }
        .navbar-nav {
            display: block;
        }

        .img {
            max-width: 100%;
            height: auto;
            width: 100%; /* ie8 */
        }
    }

    .video { position: relative; }

    .video a {
        position: absolute;
        display: block;
        background: url('{{url('public/jayakari/bic/regular/img/play_1.svg')}}');
        height: 100px;
        width: 100px;
        top: 50%;
        left: 50%;
        margin: -50px 0 0 -50px;
    }

    .scrollbar {
        height: 200px;
        overflow-y: auto
    }


</style>
@stop
@section('content_new')
    <div class="processing"></div>
    <section id="about" class="home-section text-center">
        <div class="row">
            <div class="col-lg-2 col-lg-offset-5">
                <hr class="marginbot-50">
            </div>
        </div>
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>INOVASI INDONESIA</h3>
                                <div style="background-color: #ffffff">
                                    @if ($banner->folder_final <> null)
                                        <a href="http://bic.web.id/public/storage/flippdf/{{$banner->folder_final}}/index.html" target="_blank">
                                    @elseif($banner->folder_inreview <> null)
                                        <a href="http://bic.web.id/public/storage/flippdf/{{$banner->folder_inreview}}/index.html" target="_blank">
                                    @endif
                                    @if($banner->cover_final <> null)
                                       <img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/{{$banner->cover_final}}" class="img"/>
                                    @elseif($banner->cover_inreview <> null)
                                        <img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/{{$banner->cover_inreview}}" class="img"/>
                                    @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 col-12">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>INOVATOR INDONESIA</h3>
                                <div style="background-color: #ffffff">
                                    <a href="#videos"><img src="<?php echo env('APP_URL')?>/public/storage/email/{{$labels["BHV"]}}" class="img"/></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading"style="margin-top: 20px;">
                                <a href="#bic" id="bic_title" name="bic_title"><h3>BUSINESS INNOVATION CENTER</h3></a>
                                <a href="#bic"><i class="fa fa-2x fa-angle-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-lg-2 col-lg-offset-5">
                    <hr class="marginbot-50">
                </div>
            </div>
            <div class="row" id="bic" name="bic">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="wow bounceInUp" data-wow-delay="0.5s">
                        <div class=" team boxed-grey" data-modal="modal-1">
                            <div class="inner">
                                <h5>UMUM</h5>
                                <!-- <p class="subtitle">Business Innovation Center</p> -->
                                <div class="avatar"><img src="<?php echo env('APP_URL')?>/public/storage/email/{{$labels["BICU"]}}" width="270px" height="193px"/></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="wow bounceInUp" data-wow-delay="0.5s">
                        <div class="team boxed-grey" data-modal="modal-2">
                            <div class="inner">
                                <h5>SWASTA/BISNIS</h5>
                                <!-- <p class="subtitle">BASS</p> -->
                                <div class="avatar"><img src="<?php echo env('APP_URL')?>/public/storage/email/{{$labels["BICS"]}}" width="270px" height="193px"/></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="wow bounceInUp" data-wow-delay="0.8s">
                        <div class="team boxed-grey" data-modal="modal-3">
                            <div class="inner">
                                <h5>AKADEMISI/TEKNISI</h5>
                                <!-- <p class="subtitle">CACHON</p> -->
                                <div class="avatar"><img src="<?php echo env('APP_URL')?>/public/storage/email/{{$labels["BICA"]}}" width="270px" height="193px"/></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="wow bounceInUp" data-wow-delay="1s">
                        <div class="team boxed-grey" data-modal="modal-4">
                            <div class="inner">
                                <h5>PEMERINTAH</h5>
                                <!-- <p class="subtitle">GUITAR</p> -->
                                <div class="avatar"><img src="<?php echo env('APP_URL')?>/public/storage/email/{{$labels["BICP"]}}" width="270px" height="193px"/></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-12" style="text-align: center">
                    <h4><a href="{{env('APP_URL')}}/general/about/bic">Info Lengkap Klik Disini</a></h4>
                </div>
            </div>
        </div>
    </section>
    <section id="news" class="home-section text-center">
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>BERITA BIC</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 marginbot-50">

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div id="berita" name="berita" class="owl-carousel owl-theme">
                        <?php
                        $num = count($latestNews);
                        for($i=0;$i<$num;$i=$i+4){
                        ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-3 col-xs-12 col-12" style="margin-top: 10px;">
                                    @if (count($latestNews[$i]->image) > 0)
                                        <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i]->judul}}/{{$latestNews[$i]->id}}"><img src="<?php echo env('APP_URL'); ?>/public/storage/news/{{$latestNews[$i]->image[0]->file300x300}}" height="250px" alt="{{$latestNews[$i]->judul}}"></a><br>
                                    @else
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" height="250px" alt="Owl Image"><br>
                                    @endif
                                    <?php $title = substr($latestNews[$i]->judul,0,65); ?>
                                    @if(strlen($latestNews[$i]->judul) > 65)
                                        <span class="img-text">{{$title}}...</span>
                                    @else
                                        <span class="img-text">{{$title}}</span>
                                    @endif<br>
                                    <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i]->judul}}/{{$latestNews[$i]->id}}" class="btn btn-primary">Read More <i class="fa fa-angle-double-right"></i></a>
                                </div>
                                @if(($i+1) < $num)
                                    <div class="col-md-3 col-xs-12 col-12" style="margin-top: 10px;">
                                        @if (count($latestNews[$i+1]->image) > 0)
                                            <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+1]->judul}}/{{$latestNews[$i+1]->id}}"><img src="<?php echo env('APP_URL'); ?>/public/storage/news/{{$latestNews[$i+1]->image[0]->file300x300}}" height="250px" alt="{{$latestNews[$i+1]->judul}}"></a><br>
                                        @else
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" height="250px" alt="Owl Image"><br>
                                        @endif
                                        <?php $title = substr($latestNews[$i+1]->judul,0,65); ?>
                                    <!--<span class="img-text">{{$latestNews[$i+1]->judul}}</span>-->
                                        @if(strlen($latestNews[$i+1]->judul) > 65)
                                            <span class="img-text">{{$title}}...</span>
                                        @else
                                            <span class="img-text">{{$title}}</span>
                                        @endif<br>
                                        <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+1]->judul}}/{{$latestNews[$i+1]->id}}" class="btn btn-primary">Read More <i class="fa fa-angle-double-right"></i> </a>
                                    </div>
                                @endif
                                @if(($i+2) < $num)
                                    <div class="col-md-3 col-xs-12 col-12" style="margin-top: 10px;">
                                        @if (count($latestNews[$i+2]->image) > 0)
                                            <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+2]->judul}}/{{$latestNews[$i+2]->id}}"><img src="<?php echo env('APP_URL'); ?>/public/storage/news/{{$latestNews[$i+2]->image[0]->file300x300}}" height="250px" alt="{{$latestNews[$i+2]->judul}}"></a><br>
                                        @else
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" height="250px" alt="Owl Image"><br>
                                        @endif
                                        <?php $title = substr($latestNews[$i+2]->judul,0,65); ?>
                                        @if(strlen($latestNews[$i+2]->judul) > 65)
                                            <span class="img-text">{{$title}}...</span>
                                        @else
                                            <span class="img-text">{{$title}}</span>
                                        @endif<br>
                                        <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+2]->judul}}/{{$latestNews[$i+2]->id}}" class="btn btn-primary">Read More <i class="fa fa-angle-double-right"></i></a><br>
                                    <!--<span class="img-text">{{$latestNews[$i+2]->judul}}</span>-->
                                    </div>
                                @endif
                                @if(($i+3) < $num)
                                    <div class="col-md-3 col-xs-12 col-12" style="margin-top: 10px;">
                                        @if (count($latestNews[$i+3]->image) > 0)
                                            <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+3]->judul}}/{{$latestNews[$i+3]->id}}"><img src="<?php echo env('APP_URL'); ?>/public/storage/news/{{$latestNews[$i+3]->image[0]->file300x300}}" height="250px" alt="{{$latestNews[$i+3]->judul}}"></a><br>
                                        @else
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" height="250px" alt="Owl Image"><br>
                                        @endif
                                        <?php $title = substr($latestNews[$i+3]->judul,0,65); ?>
                                        @if(strlen($latestNews[$i+3]->judul) > 65)
                                            <span class="img-text">{{$title}}...</span>
                                        @else
                                            <span class="img-text">{{$title}}</span>
                                        @endif<br>
                                        <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+3]->judul}}/{{$latestNews[$i+3]->id}}" class="btn btn-primary">Read More <i class="fa fa-angle-double-right"></i></a>
                                    <!--<span class="img-text">{{$latestNews[$i+3]->judul}}</span>-->
                                    </div>
                                @endif
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="pull-right">
                        <a href="{{env('APP_URL')}}/general/berita/all" class="btn btn-success">All News <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="news" class="home-section text-center">
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>BERITA BIC</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 marginbot-50">

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div id="berita" name="berita" class="owl-carousel owl-theme">
                        <?php
                        $num = count($latestNews);
                        for($i=0;$i<$num;$i=$i+4){
                        ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-3 col-xs-12 col-12" style="margin-top: 10px;">
                                    @if (count($latestNews[$i]->image) > 0)
                                        <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i]->judul}}/{{$latestNews[$i]->id}}"><img src="<?php echo env('APP_URL'); ?>/public/storage/news/{{$latestNews[$i]->image[0]->file300x300}}" height="250px" alt="{{$latestNews[$i]->judul}}"></a><br>
                                    @else
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" height="250px" alt="Owl Image"><br>
                                    @endif
                                    <?php $title = substr($latestNews[$i]->judul,0,65); ?>
                                    @if(strlen($latestNews[$i]->judul) > 65)
                                        <span class="img-text">{{$title}}...</span>
                                    @else
                                        <span class="img-text">{{$title}}</span>
                                    @endif<br>
                                    <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i]->judul}}/{{$latestNews[$i]->id}}" class="btn btn-primary">Read More <i class="fa fa-angle-double-right"></i></a>
                                </div>
                                @if(($i+1) < $num)
                                    <div class="col-md-3 col-xs-12 col-12" style="margin-top: 10px;">
                                        @if (count($latestNews[$i+1]->image) > 0)
                                            <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+1]->judul}}/{{$latestNews[$i+1]->id}}"><img src="<?php echo env('APP_URL'); ?>/public/storage/news/{{$latestNews[$i+1]->image[0]->file300x300}}" height="250px" alt="{{$latestNews[$i+1]->judul}}"></a><br>
                                        @else
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" height="250px" alt="Owl Image"><br>
                                        @endif
                                        <?php $title = substr($latestNews[$i+1]->judul,0,65); ?>
                                    <!--<span class="img-text">{{$latestNews[$i+1]->judul}}</span>-->
                                        @if(strlen($latestNews[$i+1]->judul) > 65)
                                            <span class="img-text">{{$title}}...</span>
                                        @else
                                            <span class="img-text">{{$title}}</span>
                                        @endif<br>
                                        <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+1]->judul}}/{{$latestNews[$i+1]->id}}" class="btn btn-primary">Read More <i class="fa fa-angle-double-right"></i> </a>
                                    </div>
                                @endif
                                @if(($i+2) < $num)
                                    <div class="col-md-3 col-xs-12 col-12" style="margin-top: 10px;">
                                        @if (count($latestNews[$i+2]->image) > 0)
                                            <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+2]->judul}}/{{$latestNews[$i+2]->id}}"><img src="<?php echo env('APP_URL'); ?>/public/storage/news/{{$latestNews[$i+2]->image[0]->file300x300}}" height="250px" alt="{{$latestNews[$i+2]->judul}}"></a><br>
                                        @else
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" height="250px" alt="Owl Image"><br>
                                        @endif
                                        <?php $title = substr($latestNews[$i+2]->judul,0,65); ?>
                                        @if(strlen($latestNews[$i+2]->judul) > 65)
                                            <span class="img-text">{{$title}}...</span>
                                        @else
                                            <span class="img-text">{{$title}}</span>
                                        @endif<br>
                                        <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+2]->judul}}/{{$latestNews[$i+2]->id}}" class="btn btn-primary">Read More <i class="fa fa-angle-double-right"></i></a><br>
                                    <!--<span class="img-text">{{$latestNews[$i+2]->judul}}</span>-->
                                    </div>
                                @endif
                                @if(($i+3) < $num)
                                    <div class="col-md-3 col-xs-12 col-12" style="margin-top: 10px;">
                                        @if (count($latestNews[$i+3]->image) > 0)
                                            <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+3]->judul}}/{{$latestNews[$i+3]->id}}"><img src="<?php echo env('APP_URL'); ?>/public/storage/news/{{$latestNews[$i+3]->image[0]->file300x300}}" height="250px" alt="{{$latestNews[$i+3]->judul}}"></a><br>
                                        @else
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" height="250px" alt="Owl Image"><br>
                                        @endif
                                        <?php $title = substr($latestNews[$i+3]->judul,0,65); ?>
                                        @if(strlen($latestNews[$i+3]->judul) > 65)
                                            <span class="img-text">{{$title}}...</span>
                                        @else
                                            <span class="img-text">{{$title}}</span>
                                        @endif<br>
                                        <a href="{{env('APP_URL')}}/general/berita/utama/{{$latestNews[$i+3]->judul}}/{{$latestNews[$i+3]->id}}" class="btn btn-primary">Read More <i class="fa fa-angle-double-right"></i></a>
                                    <!--<span class="img-text">{{$latestNews[$i+3]->judul}}</span>-->
                                    </div>
                                @endif
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="pull-right">
                        <a href="{{env('APP_URL')}}/general/berita/all" class="btn btn-success">All News <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="books" class="home-section text-center">
        <div class="heading-about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-xs-12 bg-light-blue">
                                <div class="wow bounceInDown" data-wow-delay="0.4s">
                                    <div class="section-heading" style="margin-top: 20px;">
                                        <h3>The Challengers</h3>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12 col-12 col-xs-12">
                                <div class="wow bounceInUp" data-wow-delay="0.2s" style="background-color: #ffffff">
                                    @if($challenger->folder_inreview <> null)
                                        <a href="http://bic.web.id/public/storage/flippdf/{{$challenger->folder_inreview}}/index.html" target="_blank" class="text-center">
                                            @endif
                                            <?php
                                            $files = explode('.',$challenger->cover_inreview);
                                            $image = $files[0].'_thumb.'.$files[1];
                                            ?>
                                            <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/{{$image}}" alt="Owl Image">
                                            @if($challenger->folder_inreview <> null)
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-xs-12">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>&nbsp;</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-xs-12">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12 bg-light-blue">
                                <div class="wow bounceInDown" data-wow-delay="0.4s">
                                    <div class="section-heading" style="margin-top: 20px;">
                                        <h3>KARYA INOVASI TERPILIH</h3>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12">
                                <div id="book" name="book" class="owl-carousel owl-theme">
                                    @foreach($books as $item)
                                        <div class="item">
                                            <a href="http://bic.web.id/public/storage/flippdf/{{$item->folder_final}}/index.html" target="_blank">
                                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/{{$item->book_final}}" alt="Owl Image"/>
                                            </a>
                                        </div>
                                @endforeach
                                <!--<div class="item"><a href="http://bic.web.id/public/storage/flippdf/109%20Inovasi%20Indonesia%202017/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20109_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/108%20Inovasi%20Indonesia%202016/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20108_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/107%20Inovasi%20Indonesia%202015/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20107_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/106%20Inovasi%20Indonesia%202014/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20106_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/105%20Inovasi%20Indonesia%202013/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20105_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/104%20Inovasi%20Indonesia%202012/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20104_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/103%20Inovasi%20Indonesia%202011/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20103_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/102%20Inovasi%20Indonesia%202010/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20102_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/101%20Inovasi%20Indonesia%202009/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20101_1.png" alt="Owl Image"></a></div>
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/100%20Inovasi%20Indonesia%202008/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/Buku%20100_1.png" alt="Owl Image"></a></div>-->
                                    <div class="item"><a href="http://bic.web.id/public/storage/flippdf/Global%20Innovation%20Forum%202016/index.html" target="_blank"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/img/tgif.png" alt="Owl Image"></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="arn" class="home-section text-center bg-white">
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>INOVASI INDONESIA BERDASARKAN KATEGORI AGENDA RISET NASIONAL (ARN)</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 marginbot-50">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{env('APP_URL')}}/general/kategori/pangan"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/1-pangan-c.png" alt="" /></a>
                            </div>

                            <div class="service-desc">
                                <!--<h5>PANGAN</h5>-->
                                <!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{env('APP_URL')}}/general/kategori/energi"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/2-energi-c.png" alt="" /></a>
                            </div>
                            <div class="service-desc">
                                <!--<h5>ENERGI</h5>-->
                                <!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{env('APP_URL')}}/general/kategori/transport"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/3-transport-c.png" alt="" /></a>
                            </div>
                            <div class="service-desc">
                                <!--<h5>TRANSPORT</h5>-->
                                <!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="wow fadeInRight" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{env('APP_URL')}}/general/kategori/tik"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/4-tik-c.png" alt="" /></a>
                            </div>
                            <div class="service-desc">
                                <!--<h5>TEKNOLOGI INFORMASI</h5>-->
                                <!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{env('APP_URL')}}/general/kategori/hankam"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/5-hankam-c.png" alt="" /></a>
                            </div>
                            <div class="service-desc">
                                <!--<h5>ENERGI</h5>-->
                                <!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{env('APP_URL')}}/general/kategori/kesehatan"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/6-kesehatan-c.png" alt="" /></a>
                            </div>
                            <div class="service-desc">
                                <!--<h5>ENERGI</h5> -->
                                <!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{env('APP_URL')}}/general/kategori/material"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/7-material-c.png" alt="" /></a>
                            </div>
                            <div class="service-desc">
                                <!--<h5>ENERGI</h5> -->
                                <!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{env('APP_URL')}}/general/kategori/lainnya"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/8-lainnya-c.png" alt="" /></a>
                            </div>
                            <div class="service-desc">
                                <!--<h5>ENERGI</h5> -->
                                <!-- <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="videos" class="home-section text-center">
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>VIDEO: INOVATOR INDONESIA</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 marginbot-50">

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <div id="video" name="video" class="owl-carousel owl-theme">
                        <?php
                        $num = count($videos);
                        for($i=0;$i<$num;$i++){
                            $videoid = '';
                            $haystack = $videos[$i]->url_youtube;
                            $needle = 'watch';
                            if (strpos($haystack, $needle) !== false){
                                //found
                                $url = explode('=',$videos[$i]->url_youtube);
                                if (count($url) > 0){
                                    $videoid = $url[count($url)-1];
                                }
                            }else{
                                //not found
                                $url = explode('/',$videos[$i]->url_youtube);
                                if (count($url) > 0){
                                    $videoid = $url[count($url)-1];
                                }
                            }
                            echo '<div class="item">';
                            //echo '<iframe type="text/html" width="400" height="300" src="https://www.youtube.com/embed/'.$videoid.'?enablejsapi=1&autoplay=0" frameborder="0" allowfullscreen></iframe>';
                            $arrvideos = explode('v=',$videos[$i]->url_youtube);
                            echo '<div class="video">';
                            echo '<img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$videos[$i]->keterangan.'" class="img-responsive" />';
                            echo '<a href="'.$videos[$i]->url_youtube.'">';
                            //echo '<img src="'.url('public/jayakari/bic/regular/img/play_1.png').'"/>';
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="inovasi" class="home-section text-center">
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;" id="inovasi_title" name="inovasi_title">
                                <h3>SISTEM MANAJEMEN INOVASI BIC</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row" style="margin-left: -100px;margin-right: -100px;">
                <div class="col-lg-12 marginbot-50">

                </div>
            </div>
            <div class="row equal" style="text-align: center">
                <div class="col-xs-12 col-sm-4 col-md-4 wow fadeInUp" data-wow-delay="0.2s" style="display:inline;vertical-align: middle;text-align: center">
                    @if($challenger->folder_inreview <> null)
                        <a href="http://bic.web.id/public/storage/flippdf/{{$challenger->folder_inreview}}/index.html" target="_blank" class="text-center">
                            @endif
                            <img src="<?php echo env('APP_URL')?>/public/storage/email/{{$labels["PIB"]}}" style="margin-top: 150px;"/>
                            @if($challenger->folder_inreview <> null)
                        </a>
                @endif
                <!--<a href="{{env('APP_URL')}}/general/buku/inreview/page/all/view"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/under_development_pre.jpg" alt="" style="margin-left:0px;margin-top: 150px;"/></a>-->
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <!--<a href="{{env('APP_URL')}}/general/buku/all/in/all/incubator"><img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/under_development.jpg" alt="" style="margin-left:0px;margin-top: 150px;"/></a>-->
                        <a href="{{env('APP_URL')}}/general/buku/all/in/all/incubator"><img src="<?php echo env('APP_URL')?>/public/storage/email/{{$labels["EIB"]}}" style="margin-top: 150px;"/></a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 style="text-align: center">
                                    <b>Statistik 100+<br>
                                        Inovasi Indonesia</b>
                                </h3>
                            </div>
                            <table class="table table-hover" id="sample_1">
                                <tbody>
                                <tr>
                                    <td><strong>USER</strong></td>
                                    <td align="right"><b><?php echo $user; ?></b></td>
                                </tr>
                                <tr>
                                    <td width="100"><strong> STATUS </strong></td>
                                    <td width="25" align="right"><strong> JUMLAH </strong></td>
                                </tr>
                                <?php
                                /*foreach($statistic as $item){
                                    echo '<tr>';
                                    echo '<td>'.$item['status'].'</td>';
                                    if ($item['jumlah'] == 0){
                                        echo '<td align="right">-</td>';
                                    }else{
                                        echo '<td align="right">'.$item['jumlah'].'</td>';
                                    }
                                    echo '</tr>';
                                }*/

                                //status baru
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[0]['status'].'</strong></td>';
                                if ($statistic[0]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[0]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //status batal
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[1]['status'].'</strong></td>';
                                if ($statistic[1]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[1]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //status revisi
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[3]['status'].'</strong></td>';
                                if ($statistic[3]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[3]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //status review
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[2]['status'].'</strong></td>';
                                if ($statistic[2]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[2]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //status inreview
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[4]['status'].'</strong></td>';
                                if ($statistic[4]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[4]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //status seleksi
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[5]['status'].'</strong></td>';
                                if ($statistic[5]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[5]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //status disimpan
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[6]['status'].'</strong></td>';
                                if ($statistic[6]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[6]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //status diterima
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[7]['status'].'</strong></td>';
                                if ($statistic[7]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[7]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //status discontinued
                                echo '<tr>';
                                echo '<td><strong>'.$statistic[8]['status'].'</strong></td>';
                                if ($statistic[8]['jumlah'] == 0){
                                    echo '<td align="right">-</td>';
                                }else{
                                    echo '<td align="right"><b>'.$statistic[8]['jumlah'].'</b></td>';
                                }
                                echo '</tr>';

                                //total proposal
                                echo '<tr>';
                                echo '<td><b>TOTAL</b></td>';
                                echo '<td align="right"><b>'.$total.'</b></td>';
                                echo '</tr>';
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <!--<div class="panel panel-danger">
                            <div class="panel-heading">
                                <h2 style="text-align: center">
                                    <b>Kandidat</b>
                                </h2> <p style="text-align: center"><b>111 Inovasi Indonesia - 2019</b></p>
                            </div>
                            <div class="panel-body">
                                <div style="padding-left:10%;text-align:center;">
                                    <a href="http://bic.web.id/public/storage/flippdf/111%20Inovasi%20Indonesia%202019/index.html" target="_blank"><img src="{{env('APP_URL')}}/public/storage/icon/111_new.png" alt="" class="img-responsive"/></a>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="partners" class="home-section text-center">
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>BIC PARTNERS</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <a href="#last"><i class="fa fa-2x fa-angle-down"></i></a>
            <div class="row">
                <div class="col-lg-2 col-lg-offset-5">
                    <hr class="marginbot-50">
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div id="partner" name="partner" class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/telkom.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/haldwin1.png" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/pertamina_hulu.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/skk_migas.jpg" class="img-responsive" alt="">
                                    </div>
                                </div><br>
                                <div class="col-md-3 col-xs-6">
                                    <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/bank_mandiri.jpg" class="img-responsive" alt="">
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/bank_bri.jpg" class="img-responsive" alt="">
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/bni.png" class="img-responsive" alt="">
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/telkomsel.jpg" class="img-responsive" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/total.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/paxel1.png" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/wika.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/prodia.jpg" class="img-responsive" alt="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/medco_energi.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/medco_cellulose.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/pos_indonesia.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/mci.jpg" class="img-responsive" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/caraka_logistic_distribution.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/aprobi.png" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/chandra_asri_petrochemical.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/df.png" class="img-responsive" alt="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/indomas.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/inotek.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/meikarta.png" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/mrin.jpg" class="img-responsive" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/syngenta.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/tirta_marta.gif" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/usaid_senada.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/sido_muncul.jpg" class="img-responsive" alt="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/oxium.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/triputra_agro_persada.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/wadhawani_foundation.jpg" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/jne.jpg" class="img-responsive" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/adaro.jpg" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/csiro.jpg" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/ifa.jpg" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/progressio.jpg" alt="">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/gapmmi.jpg" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/jayakari.jpg" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/jababeka.jpg" alt="">
                                    </div>
                                    <div class="col-md-3 col-xs-6 imageParent">
                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/jne.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6">
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/kalbe.jpg" class="img-responsive" alt="">
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/sido_muncul.jpg" class="img-responsive" alt="">
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/kimia_farma.jpg" class="img-responsive" alt="">
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/mci_management.jpg" class="img-responsive" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="faq" class="home-section text-center">
        <div class="heading-about bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="wow bounceInDown" data-wow-delay="0.4s">
                            <div class="section-heading" style="margin-top: 20px;">
                                <h3>Frequently Ask Question (FAQ)</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="faq" name="faq" value="{{json_encode($faq)}}"/>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 marginbot-50">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 style="text-align: center">
                                <b>Inovasi Indonesia</b>
                            </h4>
                        </div>
                        <div class="panel-body scrollbar" style="text-align: left">
                            <ol>
                                @foreach($faq_inoina as $item)
                                    <li><h5><a href="javascript:;" onclick="openModal({{$item->id}})"> {{$item->question}}</a></h5></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 style="text-align: center">
                                <b>Inovator Indonesia</b>
                            </h4>
                        </div>
                        <div class="panel-body scrollbar" style="text-align: left">
                            <ol>
                                @foreach($faq_torina as $item)
                                    <li><h5><a href="javascript:;" onclick="openModal({{$item->id}})">{{$item->question}}</a></h5></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 style="text-align: center">
                                <b>Proposal Inovasi</b>
                            </h4>
                        </div>
                        <div class="panel-body scrollbar" style="text-align: left">
                            <ol>
                                @foreach($faq_proina as $item)
                                    <li><h5><a href="javascript:;" onclick="openModal({{$item->id}})">{{$item->question}}</a></h5></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 style="text-align: center"><b>E-Incubator BIC</b></h4>
                        </div>
                        <div class="panel-body scrollbar" style="text-align: left">
                            <ol>
                                @foreach($faq_incina as $item)
                                    <li><h5><a href="javascript:;" onclick="openModal({{$item->id}})">{{$item->question}}</a></h5></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        $body = $("body");
        $(document).on({
            ajaxStart: function() { $body.addClass("loading"); },
            ajaxStop: function() { $body.removeClass("loading"); }
        });
        $(document).ready(function () {

            $('.navbar-toggle').click(function() {
                $(".navbar-main-collapse").removeClass('navbar-collapse','navbar-right');
                $(".navbar-main-collapse .nav").removeClass('navbar-nav');
                $('.nav').css('display','block');
                $('.collapse').css('backgroud-color','#ffffff');
                $(".navbar-main-collapse").collapse('toggle');
            });

            $(window).on('resize',function(){
                var viewportWidth = $(window).width();
                var viewportHeight = $(window).height();
                if (viewportWidth >=768 && viewportWidth <= 1319) {
                    $('.nav').css('display','none');
                    $('.navbar-toggle').css('display','block');
                }else if (viewportWidth >=1320){
                    $('.nav').css('display','block');
                    $('.navbar-toggle').css('display','none');
                }
            });

            $("#book").owlCarousel({
                margin:10,
                nav: true,
                //navText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                navText : ["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                autoplay: true,
                autoplayTimeout:1500,
                autoplayHoverPause:true,
                loop:true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            $("#partner").owlCarousel({
                items : 1,
                autoplay: true, //Set AutoPlay to 3 seconds
                loop:true,
                autoplayTimeout:2000,
                nav: true,
                //navText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                navText : ["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'>"],
                checkVisibility:false,
                autoplayHoverPause:true,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3]
            });

            $("#berita").owlCarousel({
                items : 1,
                loop  : true,
                margin : 30,
                nav : true,
                smartSpeed :900,
                //navText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                navText : ["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'>"],
                autoplayHoverPause:true,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3]
            });

            var carousel = $('#video').owlCarousel({
                margin:30,
                items:1,
                loop:true,
                nav:true,
                navText : ["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                dots:1,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 3
                    }
                }

            });

            /*window.owlTube = $(carousel).owlTube();*/

            $('#video').magnificPopup({
                delegate:'a',
                type:'iframe'
            });
        });

        function openModal(id){
            $.ajax({
                method: 'POST',
                url: '{{route('general.faq')}}',
                data: {
                    data: id
                },
                dataType: "json",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (response){
                    if (response.status == 'success'){
                        $.confirm({
                            title: 'Informasi',
                            content: response.message,
                            buttons: {
                                cancel: {
                                    text: "Ok",
                                    action: function () {
                                    }
                                }
                            }
                        });
                    }else{
                        alert('Muncul');
                    }
                },
                error: function (response) {
                    document.write(response.responseText);
                    //toastr['error'](response.responseText,"Error");
                }
            });
        }

    </script>
@stop
