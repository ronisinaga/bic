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
                <li><a href="{{env('APP_URL')}}/general/buku/{{$isibuku->buku->judul}}">{{$book}}</a></li>
            </ul>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('buku.inovasi',['nickname'=>$nickname])}}" class="btn btn-primary"><i class="fa fa-eye"></i> Inovasi lainnya dari inovator</a>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        <!--<a href="{{route('buku.proposal',['id'=>$isibuku->id_proposal])}}" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat Isi Proposal Terkait</a>-->
                    </div>
                </div>
            </div>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <div class="content-page">
                        <div class="row">
                            <!-- BEGIN LEFT SIDEBAR -->
                            <div class="col-md-12 col-sm-12 blog-posts">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <h3><b>{{$isibuku->judul_singkat}}</b></h3>
                                        <h5>{{$isibuku->judul_lengkap}}</h5>
                                        <p><b>Deskripsi Singkat</b></p>
                                        <hr class="blog-post-sep">
                                        <?php echo $isibuku->deskripsi_singkat; ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <h3><b><b>{{$isibuku->short_title}}</b></b></h3>
                                        <h5>&nbsp;</h5>
                                        <p><b>Short Description</b></p>
                                        <hr class="blog-post-sep">
                                        <?php echo $isibuku->short_description; ?>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h5><b>Perspektif</b></h5>
                                        <hr>
                                        <?php echo $isibuku->perspektif; ?>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h5><b>Keunggulan Inovasi: </b></h5>
                                        <hr>
                                        <?php echo $isibuku->keunggulan_inovasi; ?>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h5><b>Potensi Aplikasi: </b></h5>
                                        <hr>
                                        <?php echo $isibuku->potensi_aplikasi; ?>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h5><b>Innovator: </b></h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3">
                                                        <p><b>Tim Inovasi</b></p>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <?php echo $isibuku->inovator; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3">
                                                        <p><b>Institusi</b></p>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <?php echo $isibuku->institusi; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3">
                                                        <p><b>Alamat</b></p>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <?php echo $isibuku->alamat; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3">
                                                        <p><b>Status Paten</b></p>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <?php
                                                            switch($isibuku->id_paten){
                                                                case 1:
                                                                    echo '<p>Telah Terdaftar</p>';
                                                                    break;
                                                                case 2:
                                                                    echo '<p>Dalam Proses Pengajuan</p>';
                                                                    break;
                                                                case 3:
                                                                    echo '<p>Belum Didaftarkan</p>';
                                                                    break;
                                                                case 4:
                                                                    echo '<p>Tidak Ingin Didaftarkan</p>';
                                                                    break;
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3">
                                                        <p><b>Kesiapan Inovasi</b></p>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <?php
                                                        switch($isibuku->id_paten){
                                                            case 1:
                                                                echo '<p>*** Telah Dikomersialkan</p>';
                                                                break;
                                                            case 2:
                                                                echo '<p>** Siap Dikomersialkan</p>';
                                                                break;
                                                            case 3:
                                                                echo '<p>* Prototype</p>';
                                                                break;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3">
                                                        <p><b>Kerjasama bisnis</b></p>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <?php
                                                        switch($isibuku->id_paten){
                                                            case 1:
                                                                echo '<p>*** Terbuka</p>';
                                                                break;
                                                            case 2:
                                                                echo '<p>** Luas</p>';
                                                                break;
                                                            case 3:
                                                                echo '<p>* Terbatas</p>';
                                                                break;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3">
                                                        <p><b>Peringkat Inovasi</b></p>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <?php
                                                        switch($isibuku->id_paten){
                                                            case 1:
                                                                echo '<p>*** Paling Prospektif</p>';
                                                                break;
                                                            case 2:
                                                                echo '<p>** Sangat Prospektif</p>';
                                                                break;
                                                            case 3:
                                                                echo '<p>* Prospektif</p>';
                                                                break;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h5><b>File </b></h5>
                                        <hr>
                                        <?php
                                            /*$num = count($isibuku->file);
                                            if ($num == 0){
                                                echo '<p>Tidak ada</p>';
                                            }else{
                                                echo '<div class="content-page">';
                                                echo '<div class="filter-v1">';
                                                echo '<div class="row mix-grid thumbnails">';
                                                for($i=0;$i<$num;$i=$i+3){
                                                    echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                    echo '<div class="mix-inner">';
                                                    //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                    echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i]->path.'" class="img-responsive">';
                                                    echo '<div class="mix-details">';
                                                    echo '<p style="color:#fff">'.$isibuku->file[$i]->keterangan.'</p>';
                                                    echo '<a href="'.env('APP_URL').'/general/download/'.$isibuku->file[$i]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    if ($num > 1){
                                                        echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                        echo '<div class="mix-inner">';
                                                        //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                        echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+1]->path.'" class="img-responsive">';
                                                        echo '<div class="mix-details">';
                                                        echo '<p style="color:#fff">'.$isibuku->file[$i+1]->keterangan.'</p>';
                                                        echo '<a href="'.env('APP_URL').'/general/download/'.$isibuku->file[$i+1]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                    if ($num > 2){
                                                        echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                        echo '<div class="mix-inner">';
                                                        //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                        echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+2]->path.'" class="img-responsive">';
                                                        echo '<div class="mix-details">';
                                                        echo '<p style="color:#fff">'.$isibuku->file[$i+2]->keterangan.'</p>';
                                                        echo '<a href="'.env('APP_URL').'/general/download/'.$isibuku->file[$i+2]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                }

                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }*/
                                            $num = count($proposal->filePemenang);
                                            if ($num == 0){
                                                echo '<p>Tidak ada</p>';
                                            }else{
                                                echo '<div class="content-page">';
                                                echo '<div class="filter-v1">';
                                                echo '<div class="row mix-grid thumbnails">';
                                                for($i=0;$i<$num;$i=$i+3){
                                                    echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                    echo '<div class="mix-inner">';
                                                    //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                    echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" class="img-responsive">';
                                                    echo '<div class="mix-details">';
                                                    echo '<p style="color:#fff">'.$proposal->filePemenang[$i]->description.'</p>';
                                                    echo '<a href="'.env('APP_URL').'/general/downloadFile/'.$proposal->filePemenang[$i]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    if ($num > 1){
                                                        echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                        echo '<div class="mix-inner">';
                                                        //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                        echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" class="img-responsive">';
                                                        echo '<div class="mix-details">';
                                                        echo '<p style="color:#fff">'.$proposal->filePemenang[$i+1]->description.'</p>';
                                                        echo '<a href="'.env('APP_URL').'/general/downloadFile/'.$proposal->filePemenang[$i+1]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                    if ($num > 2){
                                                        echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                        echo '<div class="mix-inner">';
                                                        //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                        echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" class="img-responsive">';
                                                        echo '<div class="mix-details">';
                                                        echo '<p style="color:#fff">'.$proposal->filePemenang[$i+2]->description.'</p>';
                                                        echo '<a href="'.env('APP_URL').'/general/downloadFile/'.$proposal->filePemenang[$i+2]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                }

                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h5><b>Video </b></h5>
                                        <hr>
                                        <?php
                                        //$num = count($isibuku->video);
                                        $num = count($proposal->videoPemenang);
                                        if ($num == 0){
                                            echo '<p>Tidak ada</p>';
                                        }else{  ?>
                                            <div class="content-page">
                                            <div class="filter-v1">
                                                <div class="row mix-grid thumbnails" id="video">
                                                    <?php
                                                        for($i=0;$i<$num;$i=$i+3){
                                                            echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                                            echo '<div class="mix-inner">';
                                                            //$arrvideos = explode('v=',$isibuku->video[$i]->url_youtube);
                                                            //echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$isibuku->video[$i+1]->keterangan.'" class="img-responsive" /></a>';
                                                            echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$proposal->videoPemenang[$i]->video_id.'"><img src="http://img.youtube.com/vi/'.$proposal->videoPemenang[$i]->video_id.'/hqdefault.jpg" alt="'.$proposal->videoPemenang[$i]->description.'" class="img-responsive" /></a>';
                                                            echo '<div class="mix-details">';
                                                            echo '<p>'.$proposal->videoPemenang[$i]->description.'</p>';
                                                            echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$proposal->videoPemenang[$i]->video_id.'" class="mix-link"><i class="fa fa-link"></i></a>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                            echo '</div>';

                                                            if ($num > $i+1){
                                                                echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                                                echo '<div class="mix-inner">';
                                                                //$arrvideos = explode('v=',$isibuku->video[$i+1]->url_youtube);
                                                                //echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$isibuku->video[$i+1]->keterangan.'" class="img-responsive" /></a>';
                                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$proposal->videoPemenang[$i+1]->video_id.'"><img src="http://img.youtube.com/vi/'.$proposal->videoPemenang[$i+1]->video_id.'/hqdefault.jpg" alt="'.$proposal->videoPemenang[$i+1]->description.'" class="img-responsive" /></a>';
                                                                echo '<div class="mix-details">';
                                                                //echo '<p>'.$isibuku->video[$i+1]->keterangan.'</p>';
                                                                echo '<p>'.$proposal->videoPemenang[$i+1]->description.'</p>';
                                                                //echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="mix-link"><i class="fa fa-link"></i></a>';
                                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$proposal->videoPemenang[$i+1]->video_id.'" class="mix-link"><i class="fa fa-link"></i></a>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                            }

                                                            if ($num > $i+2){
                                                                echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                                                echo '<div class="mix-inner">';
                                                                //$arrvideos = explode('v=',$videos[$i+2]->url_youtube);
                                                                //echo '<img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$videos[$i+2]->keterangan.'" class="img-responsive" />';
                                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$proposal->videoPemenang[$i+2]->video_id.'"><img src="http://img.youtube.com/vi/'.$proposal->videoPemenang[$i+2]->video_id.'/hqdefault.jpg" alt="'.$proposal->videoPemenang[$i+2]->description.'" class="img-responsive" /></a>';
                                                                echo '<div class="mix-details">';
                                                                //echo '<p>'.$videos[$i+2]->keterangan.'</p>';
                                                                echo '<p>'.$proposal->videoPemenang[$i+2]->description.'</p>';
                                                                //echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="mix-link"><i class="fa fa-link"></i></a>';
                                                                echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$proposal->videoPemenang[$i+2]->video_id.'" class="mix-link"><i class="fa fa-link"></i></a>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                    ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php   }
                                        ?>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h5><b>Perkembangan Inovasi </b></h5>
                                        <hr>
                                        @foreach($proposal->advancedPemenang as $item)
                                            <blockquote>
                                                <?php echo $item->description ?>
                                            </blockquote>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <!-- END LEFT SIDEBAR -->
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