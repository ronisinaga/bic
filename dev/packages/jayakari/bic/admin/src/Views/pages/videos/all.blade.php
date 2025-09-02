@extends('jayakari.navigator.general::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/popdown/css/jquery.popdown.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/navigator/regular/pages/css/loading.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/navigator/regular/pages/home/css/index.css" rel="stylesheet" type="text/css" media="all">
@stop
@section('content')
    <div class="processing"></div>
    <!-- Header END -->
    <div class="main">
        <!-- Content -->
        <div class="main-content">
            <!-- Trending line -->
            <div class="trending-posts-line">
                <div class="container">
                    <div class="trending-line">
                        <div class="trending-now">{{$labels["BNEWS"]}}</div>
                        <div class="tl-slider">
                            @foreach($latestNews as $item)
                                <div><a href="<?php echo env('APP_URL'); ?>/berita?uid={{$item->id}}&bid={{$item->title}}">{{$item->title}}</a></div>
                            @endforeach
                        </div>
                        <div class="tl-slider-control"></div>
                    </div>
                </div>
            </div>
            <div class="main">
                <!-- Content -->
                <div class="main-content">
                    <!-- Main posts -->
                    <div class="main-posts-3">
                        <div class="mp-section">
                            <?php
                                if (count($videos) >= 5){
                                        echo '<div class="half sm-full">';
                                        echo '<article class="post post-tp-12">';
                                        echo '<figure>';
                                        $arrvideos = explode('v=',$videos[0]->url_youtube);
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/maxresdefault.jpg" height="500" width="568" alt="{{$item->keterangan}}" class="adaptive" /></a>';
                                        echo '</figure>';
                                        echo '<div class="ptp-1-overlay">';
                                        echo '<div class="ptp-1-data">';
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                        echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                        echo '<h2 class="title-13"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[0]->keterangan.'</a></h2>';
                                        $date = new DateTime($videos[0]->created_date);
                                        echo '<div class="meta-tp-1">';
                                        echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                        echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[0]->views.'</span></a></div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</article>';
                                        echo '</div>';

                                        //video kedua
                                        echo '<div class="half sm-full">';
                                        echo '<div class="half">';
                                        echo '<article class="post post-tp-12">';
                                        echo '<figure>';
                                        $arrvideos = explode('v=',$videos[1]->url_youtube);
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/mqdefault.jpg" height="248" width="282" alt="Spectr News Theme" class="adaptive" /></a>';
                                        echo '</figure>';
                                        echo '<div class="ptp-1-overlay">';
                                        echo '<div class="ptp-1-data">';
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                        echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                        echo '<h5 class="title-15"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[1]->keterangan.'</a></h5>';
                                        $date = new DateTime($videos[1]->created_date);
                                        echo '<div class="meta-tp-1">';
                                        echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                        echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[1]->views.'</span></a></div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</article>';
                                        echo '<article class="post post-tp-12">';
                                        echo '<figure>';
                                        $arrvideos = explode('v=',$videos[2]->url_youtube);
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/mqdefault.jpg" height="248" width="282" alt="Spectr News Theme" class="adaptive" /></a>';
                                        echo '</figure>';
                                        echo '<div class="ptp-1-overlay">';
                                        echo '<div class="ptp-1-data">';
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                        echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                        echo '<h5 class="title-15"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[2]->keterangan.'</a></h5>';
                                        $date = new DateTime($videos[1]->created_date);
                                        echo '<div class="meta-tp-1">';
                                        echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                        echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[2]->views.'</span></a></div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</article>';
                                        echo '</div>';
                                        echo '<div class="half">';
                                        echo '<article class="post post-tp-12">';
                                        echo '<figure>';
                                        $arrvideos = explode('v=',$videos[3]->url_youtube);
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/mqdefault.jpg" height="248" width="282" alt="Spectr News Theme" class="adaptive" /></a>';
                                        echo '</figure>';
                                        echo '<div class="ptp-1-overlay">';
                                        echo '<div class="ptp-1-data">';
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                        echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                        echo '<h5 class="title-15"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[3]->keterangan,'</a></h5>';
                                        $date = new DateTime($videos[3]->created_date);
                                        echo '<div class="meta-tp-1">';
                                        echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                        echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[3]->views.'</span></a></div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</article>';
                                        echo '<article class="post post-tp-12">';
                                        echo '<figure>';
                                        $arrvideos = explode('v=',$videos[4]->url_youtube);
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/mqdefault.jpg" height="248" width="282" alt="Spectr News Theme" class="adaptive" /></a>';
                                        echo '</figure>';
                                        echo '<div class="ptp-1-overlay">';
                                        echo '<div class="ptp-1-data">';
                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                        echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                        echo '<h5 class="title-15"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[4]->keterangan.'</a></h5>';
                                        $date = new DateTime($videos[4]->created_date);
                                        echo '<div class="meta-tp-1">';
                                        echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                        echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[4]->views.'</span></a></div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</article>';
                                        echo '</div>';
                                        echo '</div>';

                                }else{
                                    echo '<div class="half sm-full">';
                                    echo '<article class="post post-tp-12">';
                                    echo '<figure>';
                                    $arrvideos = explode('v=',$videos[0]->url_youtube);
                                    echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/maxresdefault.jpg" height="500" width="568" alt="{{$item->keterangan}}" class="adaptive" /></a>';
                                    echo '</figure>';
                                    echo '<div class="ptp-1-overlay">';
                                    echo '<div class="ptp-1-data">';
                                    echo '<h2 class="title-13"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[0]->keterangan.'</a></h2>';
                                    echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                    echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                    $date = new DateTime($videos[0]->created_date);
                                    echo '<div class="meta-tp-1">';
                                    echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                    echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[0]->views.'</span></a></div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</article>';
                                    echo '</div>';

                                    echo '<div class="half sm-full">';
                                    if (count($videos) >=2 && count($videos) < 4){
                                        echo '<div class="half">';
                                        for($i=1;$i<3;$i++){
                                            if ($i < count($videos)){
                                                echo '<article class="post post-tp-12">';
                                                echo '<figure>';
                                                $arrvideos = explode('v=',$videos[$i]->url_youtube);
                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" height="248" width="282" alt="Spectr News Theme" class="adaptive" /></a>';
                                                echo '</figure>';
                                                echo '<div class="ptp-1-overlay">';
                                                echo '<div class="ptp-1-data">';
                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                                echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                                echo '<h5 class="title-15"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[$i]->keterangan.'</a></h5>';
                                                $date = new DateTime($videos[$i]->created_date);
                                                echo '<div class="meta-tp-1">';
                                                echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                                echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[$i]->views.'</span></a></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</article>';
                                            }
                                        }
                                        echo '</div>';
                                    }else{
                                        for($i=1;$i<5;$i=$i+2){
                                            echo '<div class="half">';
                                            if ($i < count($videos)){
                                                echo '<article class="post post-tp-12">';
                                                echo '<figure>';
                                                $arrvideos = explode('v=',$videos[$i]->url_youtube);
                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/mqdefault.jpg" height="248" width="282" alt="Spectr News Theme" class="adaptive" /></a>';
                                                echo '</figure>';
                                                echo '<div class="ptp-1-overlay">';
                                                echo '<div class="ptp-1-data">';
                                                echo '<h5 class="title-15"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[$i]->keterangan.'</a></h5>';
                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                                echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                                $date = new DateTime($videos[$i]->created_date);
                                                echo '<div class="meta-tp-1">';
                                                echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                                echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[$i]->views.'</span></a></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</article>';
                                            }
                                            if (($i+1) < count($videos)){
                                                echo '<article class="post post-tp-12">';
                                                echo '<figure>';
                                                $arrvideos = explode('v=',$videos[($i+1)]->url_youtube);
                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/mqdefault.jpg" height="248" width="282" alt="Spectr News Theme" class="adaptive" /></a>';
                                                echo '</figure>';
                                                echo '<div class="ptp-1-overlay">';
                                                echo '<div class="ptp-1-data">';
                                                echo '<h5 class="title-15"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[($i+1)]->keterangan.'</a></h5>';
                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                                echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:45px;margin-top:40px;"><i></i></span>';
                                                $date = new DateTime($videos[($i+1)]->created_date);
                                                echo '<div class="meta-tp-1">';
                                                echo '<div class="ptp-1-date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                                echo '<div class="ptp-1-views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[($i+1)]->views.'</span></a></div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</article>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
            <!-- Trending line END -->
            <!-- Main posts -->
                    <div class="section">
                        <div class="row">
                            <div class="content">
                                <div class="pst-block">
                                    <div class="pst-block-main">
                                        <div class="posts">
                                            <?php
                                                if (count($videos) > 5){
                                                    for($i=5;$i<count($videos);$i++){
                                                        echo '<article class="post post-tp-17">';
                                                        echo '<figure>';
                                                        $arrvideos = explode('v=',$videos[$i]->url_youtube);
                                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/default.jpg" height="248" width="282" alt="Spectr News Theme" class="adaptive" /></a>';
                                                        echo '</figure>';
                                                        echo '<div class="ptp-1-overlay">';
                                                        echo '<div class="ptp-1-data">';
                                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="category-tp-1">Video</a>';
                                                        echo '<span class="arr-left-light-sm-ic video-sm-ic" id="svideo" name="svideo" style="margin-left:15px;margin-top:40px;"><i></i></span>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '<h3 class="title-5"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$videos[$i]->keterangan.'</a></h3>';
                                                        $date = new DateTime($videos[$i]->created_date);
                                                        echo '<div class="meta-tp-2">';
                                                        echo '<div class="date"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'">'.$date->format('F').' '.$date->format('d').', '.$date->format('Y').'</a></div>';
                                                        echo '<div class="views"><a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><i class="li_eye"></i><span>'.$videos[$i]->views.'</span></a></div>';
                                                        echo '</div>';
                                                        echo '</article>';
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <aside class="side-bar">
                                <div class="js-sidebar">
                                    <div class="pst-block">
                                        <div class="pst-block-head">
                                            <h2 class="title-4">{{$labels["BIBLEREADING"]}}</h2>
                                        </div>
                                        <div class="pst-block-main">
                                            <div class="sharing-block">
                                                <?php $date = new DateTime(); ?>
                                                {{$date->format('d M Y')}}
                                                <?php
                                                if (count($bacaan) > 0){
                                                    echo '<input type="hidden" id="bacaanid" name="bacaanid" value="{{$bacaan[0]->id}}"/>';
                                                    echo '<h4><a class="popdown btn" href="'.env('APP_URL').'/bacaanalkitab/ayat?kitab='.$bacaan[0]->id_kitab.'&pasal_awal='.$bacaan[0]->pasal_awal.'&pasal_akhir='.$bacaan[0]->pasal_akhir.'">'.$bacaan[0]->kitab->name.' '.$bacaan[0]->pasal_awal.'-'.$bacaan[0]->pasal_akhir.'</a></h4>';
                                                    echo '<div class="post-sharing-tp-2">';
                                                    echo '<div class="comments">';
                                                    echo '<button class="btn-3" id="btnRefleksi" name="btnRefleksi">'.$labels["SENDREFLECTION"].'</button>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }else{
                                                    echo "<h4>".$labels["BIBLEREADINGEMPTY"]."</h4>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sb-banner">
                                        <div class="banner-inner">
                                            <img src="<?php echo env('APP_URL'); ?>/public/jayakari/navigator/regular/layouts/images/sb-banner-img.jpg" height="270" width="320" alt="Spectr News Theme" class="adaptive" />
                                            <div class="banner-overlay">
                                                <?php
                                                if (count($ayatInspirasi) > 0){
                                                    echo '<h5 class="title-12">"'.$ayatInspirasi[0]->isi.'"</h5>';
                                                    echo '<a href="javascript" class="btn-2">'.$ayatInspirasi[0]->kitab->name.' '.$ayatInspirasi[0]->pasal_ayat.'</a>';
                                                }else{
                                                    echo '<h5 class="title-11">'.$labels["INSPIRINGVERSE"].'</h5>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pst-block">
                                        <div class="pst-block-head">
                                            <h2 class="title-4">{{$labels["PRAYING"]}}</h2>
                                        </div>
                                        <div class="pst-block-main">
                                            <div class="sharing-block">
                                                <?php
                                                if (count($pokokdoa) > 0){
                                                    $tglAwal = new DateTime($pokokdoa[0]->tanggal_awal);
                                                    $tglAkhir = new DateTime($pokokdoa[0]->tanggal_akhir);
                                                    echo '<h5 class="title-4"><b>'.$tglAwal->format('d M Y').' s/d '.$tglAkhir->format('d M Y').'</b></h5>';
                                                    echo $pokokdoa[0]->isi;
                                                }else{
                                                    echo $labels["PRAYINGEMPTY"];
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recent-nws">
                                        <div class="pst-block">
                                            <div class="pst-block-head">
                                                <h2 class="title-4"><strong>{{$labels["BNEWS"]}}</strong></h2>
                                                <div class="all-sb">
                                                    <a href="#">all news</a>
                                                </div>
                                            </div>
                                            <div class="pst-block-main">
                                                <div class="inner-filters">
                                                    <ul class="filters-list-3 js-tab-filter">
                                                        <li><a href="javascript:;" id="hlatest" name="hlatest" class="active">{{$labels["LATEST"]}}</a></li>
                                                        <li><a href="javascript:;" id="hmost" name="hmost">{{$labels["MOSTVIEWED"]}}</a></li>
                                                    </ul>
                                                </div>
                                                <hr class="pst-block-hr">
                                                <div>
                                                    <div id="latest" name="latest" style="display:block">
                                                        <?php
                                                        if (count($latestNews) == 0){
                                                            echo 'belum ada berita';
                                                        }
                                                        ?>
                                                        @foreach($latestNews as $item)
                                                            <article class="post post-tp-9">
                                                                <figure>
                                                                    <a href="<?php echo env('APP_URL'); ?>/public/{{$item->path}}{{$item->images126x98}}">
                                                                        <img src="<?php echo env('APP_URL'); ?>/public/{{$item->path}}{{$item->images126x98}}" alt="{{$item->title}}" class="adaptive" height="85" width="115">
                                                                    </a>
                                                                </figure>
                                                                <h3 class="title-6"><a href="<?php echo env('APP_URL'); ?>/berita?uid={{$item->id}}&bid={{$item->title}}">{{$item->title}}</a></h3>
                                                                <?php $date= new DateTime($item->inserted_date); ?>
                                                                <div class="date-tp-2">{{$date->format('F')}} {{$date->format('d')}}, {{$date->format('Y')}}</div>
                                                            </article>
                                                        @endforeach
                                                    </div>
                                                    <div id="most" name="most" style="display:none">
                                                        <?php
                                                        if (count($popularNews) == 0){
                                                            echo 'belum ada berita';
                                                        }
                                                        ?>
                                                        @foreach($popularNews as $item)
                                                            <article class="post post-tp-9">
                                                                <figure>
                                                                    <a href="<?php echo env('APP_URL'); ?>/public/{{$item->path}}{{$item->images126x98}}">
                                                                        <img src="<?php echo env('APP_URL'); ?>/public/{{$item->path}}{{$item->images126x98}}" alt="{{$item->title}}" class="adaptive" height="85" width="115">
                                                                    </a>
                                                                </figure>
                                                                <h3 class="title-6"><a href="<?php echo env('APP_URL'); ?>/berita?uid={{$item->id}}&bid={{$item->title}}">{{$item->title}}</a></h3>
                                                                <?php $date= new DateTime($item->inserted_date); ?>
                                                                <div class="date-tp-2">{{$date->format('F')}} {{$date->format('d')}}, {{$date->format('Y')}}</div>
                                                            </article>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="sbsb-block-1">
                                        <h4 class="title-8"><strong>Subscribe</strong> to Spectr</h4>
                                        <div class="sbsb-form-1">
                                            <div class="sbsb-form">
                                                <div class="sbsb-input">
                                                    <span class="sbsb-icon"><i class="li_mail"></i></span>
                                                    <input type="email" placeholder="E-mail">
                                                </div>
                                                <div class="sbsb-btn">
                                                    <button>subscribe</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- content-section-ends-here -->
@stop
@section('footer_page')
    <script type="text/javascript">
        var host='<?php echo env("APP_URL"); ?>';
    </script>
    <script src="<?php  echo env('APP_URL'); ?>/assets/popdown/scripts/jquery.popdown.min.js" type="text/javascript"></script>
    <script src="<?php  echo env('APP_URL'); ?>/public/jayakari/navigator/regular/pages/videos/scripts/all.js" type="text/javascript"></script>
@stop