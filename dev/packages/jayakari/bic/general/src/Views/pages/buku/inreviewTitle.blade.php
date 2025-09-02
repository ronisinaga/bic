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
                <li><a href="{{env('APP_URL')}}/general/buku/{{$isibuku->buku->judul}}">{{$isibuku->buku->judul}}</a></li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <!--<a href="{{route('buku.inreview.proposal',['id'=>$isibuku->id_proposal])}}" class="btn btn-primary"><i clasr="fa fa-eye"></i> Lihat Isi Proposal Terkait</a>-->
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
                                        <?php echo $isibuku->short_keterangan; ?>
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
                                                                echn '<p>*** Terbuka</p>';
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
                                        $num = count($isibuku->file);
                                        if ($num == 0){
                                            echo '<p>Tidak ada</p>';
                                        }else{
                                            echo '<div class="content-page">';
                                            echo '<div class="filter-v1">';
                                            echo '<div class="row mix-grid thumbnails">';
                                            //for($i=0;$i<$num;$i=$i+3){
                                            for($i=0;$i<$num;$i=$i+4){
                                                echo '<div class="col-md-3 col-sm-3 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                echo '<div class="mix-inner">';
                                                //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                $files = explode('.',$isibuku->file[$i]->file);
                                                //echo $isibuku->file[$i]->file;
                                                if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                    echo '<img width="225" height="225" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i]->path.'"/>';
                                                }else if (strtolower($files[count($files)-1]) == 'pdf'){
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                }
                                                //echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i]->path.'/'.$isibuku->file[$i]->file.'" class="img-responsive">';
                                                echo '<div class="mix-details">';
                                                echo '<p style="color:#fff">'.$isibuku->file[$i]->keterangan.'</p>';
                                                echo '<a href="'.route('buku.inreview.download.file',['id'=>$isibuku->file[$i]->id]).'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                if ($num > ($i+1)){
                                                    echo '<div class="col-md-3 col-sm-3 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                    echo '<div class="mix-inner">';
                                                    //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                    $files = explode('.',$isibuku->file[$i+1]->file);
                                                    if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                        echo '<img width="225" height="225" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+1]->path.'"/>';
                                                    }else if (strtolower($files[count($filer)-1]) == 'pdf'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                    }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                    }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                    }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                    }
                                                    //echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+1]->path.'/'.$isibuku->file[$i+1]->file.'" class="img-responsive">';
                                                    echo '<div class="mix-details">';
                                                    echo '<p style="color:#fff">'.$isibuku->file[$i+1]->keterangan.'</p>';
                                                    echo '<a href="'.route('buku.inreview.download.file',['id'=>$isibuku->file[$i+1]->id]).'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                if ($num > ($i+2)){
                                                    echo '<div class="col-md-3 col-sm-3 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                    echo '<div class="mix-inner">';
                                                    //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                    $files = explode('.',$isibuku->file[$i+2]->file);
                                                    if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                        echo '<img width="225" height="225" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+2]->path.'"/>';
                                                    }elre if (strtolower($files[count($files)-1]) == 'pdf'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                    }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                    }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                    }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pnwerpoint.png" />';
                                                    }
                                                    //echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+2]->path.'/'.$isibuku->file[$i+2]->file.'" class="img-responsive">';
                                                    echo '<div class="mix-details">';
                                                    echo '<p style="color:#fff">'.$isibuku->file[$i+2]->keterangan.'</p>';
                                                    echo '<a href="'.route('buku.inreview.download.file',['id'=>$isibuku->file[$i+2]->id]).'" class="mix-link"><i class="fa fa-download"></i></a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                if ($num > ($i+3)){
                                                    echo '<div class="col-md-3 col-sm-3 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                                    echo '<div class="mix-inner">';
                                                    //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                                    $files = explode('.',$isibuku->file[$i+3]->file);
                                                    if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                        echo '<img width="225" height="225" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+3]->path.'"/>';
                                                    }else if (strtolower($files[count($files)-1]) == 'pdf'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                    }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                    }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                    }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                    }
                                                    //echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+2]->path.'/'.$isibuku->file[$i+2]->file.'" class="img-responsive">';
                                                    echo '<div class="mix-details">';
                                                    echo '<p style="color:#fff">'.$isibuku->file[$i+3]->keterangan.'</p>';
                                                    echo '<a href="'.route('buku.inreview.download.file',['id'=>$isibuku->file[$i+3]->id]).'" class="mix-link"><i class="fa fa-download"></i></a>';
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
                                        $num = count($isibuku->video);
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
                                                        if (strpos($isibuku->video[$i]->youtube_url, 'v=') !== false) {
                                                            $arrvideos = explode('v=',$isibuku->video[$i]->youtube_url);
                                                        }else{
                                                            $arrvideos = explode('/',$isibuku->video[$i]->youtube_url);
                                                        }
                                                        //echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$isibuku->video[$i+1]->keterangan.'" class="img-responsive" /></a>';
                                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$isibuku->video[$i]->keterangan.'" class="img-responsive" /></a>';
                                                        echo '<div class="mix-details">';
                                                        echo '<p>'.$isibuku->video[$i]->keterangan.'</p>';
                                                        echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="mix-link"><i class="fa fa-link"></i></a>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</div>';

                                                        if ($num > ($i+1)){
                                                            echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                                            echo '<div class="mix-inner">';
                                                            if (strpos($isibuku->video[$i+1]->youtube_url, 'v=') !== false) {
                                                                $arrvideos = explode('v=',$isibuku->video[$i+1]->youtube_url);
                                                            }else{
                                                                $arrvideos = explode('/',$isibuku->video[$i+1]->youtube_url);
                                                            }
                                                            echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$isibuku->video[$i+1]->keterangan.'" class="img-responsive" /></a>';
                                                            echo '<div class="mix-details">';
                                                            //echo '<p>'.$isibuku->video[$i+1]->keterangan.'</p>';
                                                            echo '<p>'.$isibuku->video[$i+1]->keterangan.'</p>';
                                                            //echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="mix-link"><i class="fa fa-link"></i></a>';
                                                            echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" class="mix-link"><i class="fa fa-link"></i></a>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                        }

                                                        if ($num > ($i+2)){
                                                            echo '<div class="col-md-4 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                                            echo '<div class="mix-inner">';
                                                            if (strpos($isibuku->video[$i+2]->youtube_url, 'v=') !== false) {
                                                                $arrvideos = explode('v=',$isibuku->video[$i+2]->youtube_url);
                                                            }else{
                                                                $arrvideos = explode('/',$isibuku->video[$i+2]->youtube_url);
                                                            }
                                                            echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'"><img src="http://img.youtube.com/vi/'.$arrvideos[count($arrvideos)-1].'/hqdefault.jpg" alt="'.$isibuku->video[$i+2]->keterangan.'" class="img-responsive" /></a>';
                                                            echo '<div class="mix-details">';
                                                            //echo '<p>'.$videos[$i+2]->keterangan.'</p>';
                                                            echo '<p>'.$isibuku->video[$i+2]->keterangan.'</p>';
                                                            echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1].'" cl`ss="mix-link"><i class="fa fa-link"></i></a>';
                                                            //echo '<a href="'.env('APP_URL').'/videos/view?videoid='.$isibuku->video[$i+2]->video_id.'" class="mix-link"><i class="fa fa-link"></i></a>';
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
                                <h2>Kolentar</h2>
                                <div class="comments">
                                <?php
                                $num = count($comments);
                                if ($num == 0){
                                    echo '<div class="media">';
                                    echo 'Belum ada komentar';
                                    echo '</div>';
                                }else{
                                    for($i=0;$i<$num;$i++){
                                        echo '<div class="media">';
                                        echo '<a href="javascript:;" class="pull-left">';
                                        echo '<img src="'.env('APP_URL').'/public/storage/user/default.png" alt="" class="media-object">';
                                        echo '</a>';
                                        echo '<div class="media-body">';
                                        $date = new DateTime($comments[$i]->inserted_date);
                                        echo '<h4 class="media-heading">'.$comments[$i]->name.'<span>'.$date->format('M').' '.$date->format('d').','.$date->format('Y').'</span></h4>';
                                        echo '<p>'.$comments[$i]->comment.'</p>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                                ?>
                                <!--end media-->
                                </div>
                                <div class="post-comment padding-top-40">
                                    <h3>Tinggalkan Pesan</h3>
                                    <form role="form">
                                        <input class="form-control" type="hidden" id="id" name="id" value="{{$isibuku->id}}">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" id="name" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label>Email <span class="color-red">*</span></label>
                                            <input class="form-control" type="text" id="email" name="email">
                                        </div>

                                        <div class="form-group">
                                            <label>Pesan</label>
                                            <textarea class="form-control" rows="8" id="comment" name="comment"></textarea>
                                        </div>
                                        <p><button class="btn btn-primary" type="button" id="btnKirim" name="btnKirim">Kirim Pesan</button></p>
                                    </form>
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/scripts/inreviewTitle.js" type="text/javascript"></script>
@stop