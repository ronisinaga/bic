@extends('jayakari.bic.general::layouts.default')
@section('header_page')
<link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/css/portfolio.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
<link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/css/TimeCircles.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <!-- BEGIN SLIDER -->
    <div class="page-slider margin-bottom-40">
        <div id="carousel-example-generic" class="carousel slide carousel-slider">
            <!-- Indicators -->
            <ol class="carousel-indicators carousel-indicators-frontend">
                <?php
                $index =0;
                $num = count($banner);
                for($i=0;$i<$num;$i++){
                    if ($i==0){
                        echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>';
                    }else{
                        echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
                    }
                }
                ?>
            </ol>


            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- First slide -->
                <?php
                $index =0;
                $num = count($banner);
                for($i=0;$i<$num;$i++){
                    if ($i==0){
                        echo '<div class="item active">';
                        echo '<img src="'.env('APP_URL').'/public/storage/'.$banner[$i]->path.'" style="min-width:100%;min-height:365px;height:365px;width:auto"/>';
                        echo '</div>';
                    }else{
                        echo '<div class="item">';
                        echo '<img src="'.env('APP_URL').'/public/storage/'.$banner[$i]->path.'" style="min-width:100%;min-height:365px;height:365px;width:auto"/>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <!-- END SLIDER -->
    <!--count down -->
    <!--<div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-align: center"><label style="color: red">COUNTDOWN</label> MENUJU PENETAPAN 110 INOVASI INDONESIA TERPILIH:</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-9">
                    <div id="DateCountdown" data-date="2018-10-16 00:00:00" style="width: 500px; height: 125px; padding: 0px; box-sizing: border-box;"></div>
                </div>
            </div>
		</div>
	</div><br>-->
    <!-- end count down -->
    <div class="main">
        <!-- BEGIN SERVICE BOX -->
        <div class="container">
            <div class="row service-box margin-bottom-40">
                <div class="col-md-2 col-xs-12" style="padding-right: 65px;">
                    <div class="service-box-heading">
                        <a href="javascript:;" id="a_pangan" name="a_pangan">
                            <img id="pangan" name="pangan" src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/icons/1-pangan-b.png"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12" style="padding-right: 65px;">
                    <div class="service-box-heading">
                        <a href="javascript:;" id="a_energi" name="a_energi">
                            <img id="energi" name="energi" src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/icons/2-energi-b.png"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12" style="padding-right: 65px;">
                    <div class="service-box-heading">
                        <a href="javascript:;" id="a_transport" name="a_transport">
                            <img id="transport" name="transport" src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/icons/3-transport-b.png"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12" style="padding-right: 65px;">
                    <div class="service-box-heading">
                        <a href="javascript:;" id="a_tik" name="a_tik">
                            <img id="tik" name="tik" src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/icons/4-tik-b.png"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12" style="padding-right: 65px;">
                    <div class="service-box-heading">
                        <a href="javascript:;" id="a_hankam" name="a_pangan">
                            <img id="hankam" name="hankam" src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/icons/5-hankam-b.png"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12" style="padding-right: 65px;">
                    <div class="service-box-heading">
                        <a href="javascript:;" id="a_kesehatan" name="a_kesehatan">
                            <img id="kesehatan" name="kesehatan" src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/icons/6-kesehatan-b.png"/>
                        </a>
                    </div>
                </div>

                <div class="col-md-2 col-xs-12" style="padding-right: 65px;">
                    <div class="service-box-heading">
                        <a href="javascript:;" id="a_material" name="a_material">
                            <img id="material" name="material" src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/icons/7-material-b.png"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12" style="padding-right: 65px;">
                    <div class="service-box-heading">
                        <a href="javascript:;" id="a_lainnya" name="a_lainnya">
                            <img id="lainnya" name="lainnya" src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/icons/8-lainnya-b.png"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SERVICE BOX -->
        <div class="container">
            <!-- BEGIN BLOCKQUOTE BLOCK -->
            <div class="row quote-v1 margin-bottom-30">
                <div class="col-md-12">
                    <span>
                        BIC - Business Innovation Center
                    </span>
                </div>
            </div>
            <!-- END BLOCKQUOTE BLOCK -->

            <!-- BEGIN RECENT WORKS -->
            <div class="row recent-work margin-bottom-40">
                <div class="col-md-3">
                    <h2><a href="javascript:;">BIC Ebook</a></h2>
                    <p>Kumpulan ebook-ebook BIC</p>
                    <img src="{{env('APP_URL')}}/public/jayakari/bic/regular/corporates/img/logos/logo_bic.png">
                </div>
                <div class="col-md-9">
                    <div class="owl-carousel owl-carousel3">
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/110_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/110-Inovasi Indonesia 2018/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>110 Inovasi Indonesia 2018</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/tgif_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/Global Innovation Forum 2016/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>Global Innovation Forum 2016</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/109.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/109 Inovasi Indonesia 2017/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>109 Inovasi Indonesia 2017</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/108_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/108 Inovasi Indonesia 2016/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>108 Inovasi Indonesia 2016</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/107_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/107 Inovasi Indonesia 2015/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>107 Inovasi Indonesia 2015</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/106_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/106 Inovasi Indonesia 2014/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>106 Inovasi Indonesia 2014</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/105_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/105 Inovasi Indonesia 2013/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>105 Inovasi Indonesia 2013</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/104_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/104 Inovasi Indonesia 2012/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>104 Inovasi Indonesia 2012</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/103_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/103 Inovasi Indonesia 2011/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>103 Inovasi Indonesia 2011</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/102_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/102 Inovasi Indonesia 2010/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>102 Inovasi Indonesia 2010</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/101_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/101 Inovasi Indonesia 2009/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>101 Inovasi Indonesia 2009</strong>
                            </a>
                        </div>
                        <div class="recent-work-item">
                            <em>
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/100_new.png" alt="Amazing Project" class="img-responsive">
                                <a href="http://bicbook.innovation.id/100 Inovasi Indonesia 2008/index.html" target="_blank"><i class="fa fa-link"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>100 Inovasi Indonesia 2008</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END RECENT WORKS -->

            <!-- BEGIN TABS AND TESTIMONIALS -->
            <div class="row mix-block margin-bottom-40">
                <!-- TABS -->
                <div class="col-md-9 tab-style-1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-1" data-toggle="tab">Berita Terbaru</a></li>
                        <li><a href="#tab-2" data-toggle="tab">Berita Populer</a></li>
                        <li><a href="#tab-3" data-toggle="tab">Agenda Kerja</a></li>
                        <li><a href="#tab-4" data-toggle="tab">Inovasi Unggulan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-1">
                            @foreach($latestNews as $item)
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <!--<a href="<?php echo env('APP_URL'); ?>/public/storage/<?php echo $item->image[0]->path ?>" class="fancybox-button" title="Image Title" data-rel="fancybox-button">-->
                                            <img class="img-responsive" src="<?php echo env('APP_URL'); ?>/public/storage/<?php echo $item->image[0]->path ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h4 class="margin-bottom-10"><b>{{$item->judul}}</b></h4>
                                        <?php $isi = substr(strip_tags($item->isi),0,500); ?>
                                        <p class="margin-bottom-10"><?php echo $isi ?>...</p>
                                        <?php
                                            $judul = str_replace("+","_",$item->judul);
                                            $urlencode = urlencode($judul);
                                        ?>
                                        <p><a class="more" href="<?php echo env('APP_URL'); ?>/general/berita/utama/{{$urlencode}}">Read more <i class="icon-angle-right"></i></a></p>
                                    </div>
                                </div><br>
                            @endforeach
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <a href="{{env('APP_URL')}}/general/berita/all">Berita Lainnya >></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-2">
                            @foreach($popularNews as $item)
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <a href="<?php echo env('APP_URL'); ?>/public/storage/<?php echo $item->image[0]->path ?>" class="fancybox-button" title="Image Title" data-rel="fancybox-button">
                                            <img class="img-responsive" src="<?php echo env('APP_URL'); ?>/public/storage/<?php echo $item->image[0]->path ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h4 class="margin-bottom-10"><b>{{$item->judul}}</b></h4>
                                        <?php $isi = substr(strip_tags($item->isi),0,500); ?>
                                        <p class="margin-bottom-10"><?php echo $isi ?></p>
                                        <?php $urlencode = urlencode($item->judul);?>
                                        <p><a class="more" href="<?php echo env('APP_URL'); ?>/general/berita/utama/{{$urlencode}}">Read more <i class="icon-angle-right"></i></a></p>
                                    </div>
                                </div><br>
                            @endforeach
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <a href="{{env('APP_URL')}}/general/berita/all">Berita Lainnya >></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-3">

                        </div>
                        <div class="tab-pane fade" id="tab-4">
                            <?php
                            //$num = count($inovasiunggulan);
                            if ($inovasiunggulan == null){
                                echo '<div class="row">';
                                echo '<div class=col-md-12>';
                                echo '<p>Tidak ada Inovasi Unggulan yang ditampilkan</p>';
                                echo '</div>';
                                echo '</div>';
                            }else{
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo $inovasiunggulan->keterangan; ?>
                                </div>
                            </div>
                            @foreach($inovasiunggulan->isi as $item)
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <a href="<?php echo env('APP_URL'); ?>/public/storage/{{$item->isiBuku->file[0]->path}}" class="fancybox-button" title="Image Title" data-rel="fancybox-button">
                                            <img class="img-responsive" src="<?php echo env('APP_URL'); ?>/public/storage/{{$item->isiBuku->file[0]->path}}" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h4 class="margin-bottom-10"><b>{{$item->isiBuku->judul_singkat}}</b></h4>
                                        <p class="margin-bottom-10">
                                            <?php
                                            $preview = substr($item->isiBuku->deskripsi_singkat,0,500);
                                            echo $preview.'...';
                                            $urlencode = urlencode($item->isiBuku->judul_singkat);
                                            ?>
                                        </p>
                                        <p><a class="more" href="{{env('APP_URL')}}/general/view/{{$urlencode}}">Baca seluruhnya <i class="icon-angle-right"></i></a></p>
                                    </div>
                                </div>
                            @endforeach
                            <?php   }   ?>
                        </div>
                    </div>
                </div>
                <!-- END TABS -->

                <!-- TESTIMONIALS -->
                <div class="col-md-3 testimonials-v1">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 style="text-align: left">
                                <b>Program BIC - 2019</b>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <a href="{{url('/general/login/')}}"><img src="{{env('APP_URL')}}/public/storage/icon/111_Inovasi_Indonesia_small.jpg" alt="" class="img-responsive"/></a><hr>
                            <a href="{{route('general.book.inreview.page')}}"><img src="{{env('APP_URL')}}/public/storage/icon/under_development_pre.jpg" alt="" class="img-responsive"/></a><hr>
                            <a href="{{route('general.book.incubator')}}"><img src="{{env('APP_URL')}}/public/storage/icon/under_development.jpg" alt="" class="img-responsive"/></a>
                            <!--<h4 style="text-align: center"><a href="http://bicbook.innovation.id/Seminar%20Inovasi/index.html">Information & Registration</a></h4>
                            <a href="http://bicbook.innovation.id/Seminar Inovasi/index.html" target="_blank"><img src="{{env('APP_URL')}}/public/storage/icon/seminar.png" alt="" class="img-responsive"/></a>-->
                        </div>
                    </div>
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
                                <td>USER</td>
                                <td align="right"><?php echo $user; ?></td>
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
                            echo '<td>'.$statistic[0]['status'].'</td>';
                            if ($statistic[0]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[0]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //status batal
                            echo '<tr>';
                            echo '<td>'.$statistic[1]['status'].'</td>';
                            if ($statistic[1]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[1]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //status revisi
                            echo '<tr>';
                            echo '<td>'.$statistic[3]['status'].'</td>';
                            if ($statistic[3]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[3]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //status review
                            echo '<tr>';
                            echo '<td>'.$statistic[2]['status'].'</td>';
                            if ($statistic[2]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[2]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //status inreview
                            echo '<tr>';
                            echo '<td>'.$statistic[4]['status'].'</td>';
                            if ($statistic[4]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[4]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //status seleksi
                            echo '<tr>';
                            echo '<td>'.$statistic[5]['status'].'</td>';
                            if ($statistic[5]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[5]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //status disimpan
                            echo '<tr>';
                            echo '<td>'.$statistic[6]['status'].'</td>';
                            if ($statistic[6]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[6]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //status diterima
                            echo '<tr>';
                            echo '<td>'.$statistic[7]['status'].'</td>';
                            if ($statistic[7]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[7]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //status discontinued
                            echo '<tr>';
                            echo '<td>'.$statistic[8]['status'].'</td>';
                            if ($statistic[8]['jumlah'] == 0){
                                echo '<td align="right">-</td>';
                            }else{
                                echo '<td align="right">'.$statistic[8]['jumlah'].'</td>';
                            }
                            echo '</tr>';

                            //total proposal
                            echo '<tr>';
                            echo '<td><b>Total</b></td>';
                            echo '<td align="right"><b>'.$total.'</b></td>';
                            echo '</tr>';
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h2 style="text-align: center">
                                <b>Kandidat</b>
                            </h2> <p style="text-align: center"><b>111 Inovasi Indonesia - 2019</b></p>
                        </div>
                        <div class="panel-body">
                            <!--<p style="text-align: center"><b>Jadilah JAWARA Inovasi Indonesia-2018 dengan mendukung penerbitan</b></p>
                            <p style="text-align: center"><b>DIGITAL</b></p>-->
                            <!--<p style="text-align: center"><b>IN-REVIEW for "111 Inovasi Indonesia"</b></p>-->
                            <!--<p style="text-align: center"><b>Silakan <a href="http://bicbook.innovation.id/110 Inovasi Indonesia 2018/index.html" target="_blank">Klik</a> di sini</b></p>-->
                            <a href="http://bicbook.innovation.id/111 Inovasi Indonesia 2019/index.html" target="_blank"><img src="{{env('APP_URL')}}/public/storage/icon/111_new.png" alt="" class="img-responsive"/></a>
                        </div>
                    </div>
                    <!--<div class="panel panel-danger">
                        <div class="panel-heading">
                            <h4 class="panel-title" style="text-align: center">
                                110 Inovasi Indonesia 2018 Terpilih
                            </h4>
                        </div>
                        <div class="panel-body">
                            <a href="http://bicbook.innovation.id/110 Inovasi Indonesia 2018 IN PROCESS/index.html" target="_blank"><img src="{{env('APP_URL')}}/public/storage/icon/110_new_terpilih.png" alt="" class="img-responsive"/></a>
                        </div>
                    </div>-->
                </div>
                <!-- END TESTIMONIALS -->
            </div>
            <!-- END TABS AND TESTIMONIALS -->
            <div class="row margin-bottom-30">
                <div class="col-md-6">
                    <div class=" quote-v1">
                        <span>Video</span>
                    </div>
                    <div class="content-page">
                        <div class="filter-v1">
                            <div class="row mix-grid thumbnails" id="video">
                                <?php
                                $num = count($videos);
                                for($i=0;$i<$num;$i=$i+2){
                                    echo '<div class="col-md-6 col-sm-6 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                    echo '<div class="mix-inner">';
                                    $arrvideos = explode('v=',$videos[$i]->url_youtube);
                                    echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$videos[$i]->keterangan.'" class="img-responsive" /></a>';
                                    echo '<div class="mix-details">';
                                    echo '<p>'.$videos[$i]->keterangan.'</p>';
                                    echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="mix-link"><i class="fa fa-link"></i></a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';

                                    if ($num > $i+1){
                                        echo '<div class="col-md-6 col-sm-6 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                        echo '<div class="mix-inner">';
                                        $arrvideos = explode('v=',$videos[$i+1]->url_youtube);
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$videos[$i+1]->keterangan.'" class="img-responsive" /></a>';
                                        echo '<div class="mix-details">';
                                        echo '<p>'.$videos[$i+1]->keterangan.'</p>';
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="mix-link"><i class="fa fa-link"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }

                                    /*if ($num > $i+2){
                                        echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                        echo '<div class="mix-inner">';
                                        $arrvideos = explode('v=',$videos[$i+2]->url_youtube);
                                        echo '<img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$videos[$i+2]->keterangan.'" class="img-responsive" />';
                                        echo '<div class="mix-details">';
                                        echo '<p>'.$videos[$i+2]->keterangan.'</p>';
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="mix-link"><i class="fa fa-link"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }*/
                                }
                                ?>
                            </div>
                        </div>
                        <div class="pull-right">
                            <p style="color: red"><a class="more" href="{{env('APP_URL')}}/general/video/all">Video Lainnya <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" quote-v1">
                        <span>Apa kata mereka tentang BIC</span>
                    </div>
                    <div class="row mix-block margin-bottom-40">
                        <!-- TABS -->
                        <div class="col-md-12 testimonials-v1">
                            <div id="myCarousel" class="carousel slide">
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <?php
                                    $num = count($testimonial);
                                    if ($num == 0){
                                        echo 'Belum ada testimonal';
                                    }else{
                                        for($i=0;$i<$num;$i++){
                                            if ($i == 0){
                                                echo '<div class="active item">';
                                                echo '<blockquote>'.$testimonial[$i]->testimonial.'</blockquote>';
                                                echo '<div class="carousel-info">';
                                                echo '<img class="pull-left" src="'. env('APP_URL').'/public/storage/'.$testimonial[$i]->path.'" alt="'.$testimonial[$i]->name.'">';
                                                echo '<div class="pull-left">';
                                                echo '<span class="testimonials-name">'.$testimonial[$i]->name.'</span>';
                                                echo '<span class="testimonials-name">'.$testimonial[$i]->pekerjaan.'</span>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }else{
                                                echo '<div class="item">';
                                                echo '<blockquote>'.$testimonial[$i]->testimonial.'</blockquote>';
                                                echo '<div class="carousel-info">';
                                                echo '<img class="pull-left" src="'. env('APP_URL').'/public/storage/'.$testimonial[$i]->path.'" alt="'.$testimonial[$i]->name.'">';
                                                echo '<div class="pull-left">';
                                                echo '<span class="testimonials-name">'.$testimonial[$i]->name.'</span>';
                                                echo '<span class="testimonials-name">'.$testimonial[$i]->pekerjaan.'</span>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>

                                <!-- Carousel nav -->
                                <a class="left-btn" href="#myCarousel" data-slide="prev"></a>
                                <a class="right-btn" href="#myCarousel" data-slide="next"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BEGIN STEPS -->
            <div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
                <div class="col-md-6 col-sm-6 front-step-col">
                    <div class="front-step front-step1">
                        <h2>Visi</h2>
                        <p>Menjadi lembaga intermediasi inovasi bisnis yang terdepan, dalam menunjang daya saing ekonomi dan Bisnis Indonesia. Hal ini dilakukan dengan mensinergikan elemen-elemen Akademisi, Business, dan Government (A-B-G) dalam proses inovasi bisnis, sehingga dalam waktu 10 tahun, kegiatan inovasi di Indonesia akan menjadi unggulan (benchmark) negara-negara lain di ASEAN.</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 front-step-col">
                    <div class="front-step front-step2">
                        <h2>Misi</h2>
                        <p>Mendorong inovasi business di Indonesia, melalui kegiatan intermediasi antara inovator pengembangan teknologi dengan dunia bisnis. Menjadi lembaga intermediasi proses inovasi bisnis, untuk menciptakan nilai tambah ekonomi dan bisnis dan daya saing nasional Indonesia.</p>
                        <br><br>
                    </div>
                </div>
                <!--<div class="col-md-4 col-sm-4 front-step-col">
                    <div class="front-step front-step3">
                        <h2>Motto</h2>
                        <p>Motto dari Business Innovation Center (BIC).</p>
                    </div>
                </div>-->
            </div>
            <!-- END STEPS -->

            <!-- BEGIN CLIENTS -->
        <!--<div class="row margin-bottom-40 our-clients">
                <div class="col-md-3">
                    <h2><a href="javascript:;">Partner Kami</a></h2>
                    <p>Partner-partner yang selama ini mendukung kegiatan kami.</p>
                </div>
                <div class="col-md-9">
                    <div class="owl-carousel owl-carousel6-brands">
                        <div class="client-item">
                            <a href="javascript:;">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_1_gray.png" class="img-responsive" alt="">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_1.png" class="color-img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="client-item">
                            <a href="javascript:;">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_2_gray.png" class="img-responsive" alt="">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_2.png" class="color-img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="client-item">
                            <a href="javascript:;">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_3_gray.png" class="img-responsive" alt="">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_3.png" class="color-img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="client-item">
                            <a href="javascript:;">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_4_gray.png" class="img-responsive" alt="">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_4.png" class="color-img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="client-item">
                            <a href="javascript:;">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_5_gray.png" class="img-responsive" alt="">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_5.png" class="color-img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="client-item">
                            <a href="javascript:;">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_6_gray.png" class="img-responsive" alt="">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_6.png" class="color-img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="client-item">
                            <a href="javascript:;">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_7_gray.png" class="img-responsive" alt="">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_7.png" class="color-img img-responsive" alt="">
                            </a>
                        </div>
                        <div class="client-item">
                            <a href="javascript:;">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_8_gray.png" class="img-responsive" alt="">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/img/clients/client_8.png" class="color-img img-responsive" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="row margin-bottom-40 our-clients">
                <div class="col-md-3">
                    <h2><a href="javascript:;">Partner Kami</a></h2>
                    <p>Partner-partner yang selama ini mendukung kegiatan kami.</p>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/telkomsel.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/bank_mandiri.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/bank_bri.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/telkom.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>
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
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/haldwin1.png" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/total.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/meikarta.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/wika.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/jababeka.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/medco_energi.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/chandra_asri_petrochemical.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/syngenta.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/adaro_energi1.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/prodia.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/aprobi.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/inotek.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/mci_management.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/csiro1.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/wadhawani_foundation.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/triputra_agro_persada.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/ifa1.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/df.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/bni.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/progressio.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/jayakari.png" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/usaid_senada.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/mrin.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/tirta_marta.gif" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/indomas.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/paxel1.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/jne.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/pos_indonesia.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/caraka_logistic_distribution.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <!--<div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/gapmmi1.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/oxium.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/caraka_group.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/mci.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/logo/medco_cellulose.jpg" class="img-responsive" alt="">
                        </div>
                    </div><br>-->
                </div>
            </div>
            <!-- END CLIENTS -->
        </div>
    </div>

@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/TimeCircles.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/index.js" type="text/javascript"></script>
@stop
