@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="processing"></div>
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Berita</a></li>
                <li><a href="javascript:;">Utama</a></li>
                <li class="active">{{$news->judul}}</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <input type="hidden" id="id" name="id" value="{{$news->id}}"/>
                    <input type="hidden" id="judul" name="judul" value="{{$news->judul}}"/>
                    <h1>{{$news->judul}}</h1><br><br>
                    <div class="content-page">
                        <div class="row">
                            <!-- BEGIN LEFT SIDEBAR -->
                            <div class="col-md-9 col-sm-9 blog-item">
                                <div class="blog-item-img">
                                    <!-- BEGIN CAROUSEL -->
                                    <div class="page-slider margin-bottom-40">
                                        <div id="carousel-example-generic" class="carousel slide carousel-slider">
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators carousel-indicators-frontend">
                                                <?php
                                                $index =0;
                                                $num = count($news->image);
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
                                            <div class="carousel-inner">
                                                <?php
                                                $num = count($news->image);
                                                for($i=0;$i<$num;$i++){
                                                    if ($i == 0){
                                                        echo '<div class="item active">';
                                                        echo '<div class="recent-work-item">';
                                                        echo '    <em>';
                                                        echo '            <img src="'.env('APP_URL').'/public/storage/'.$news->image[$i]->path.'" alt="" style="width:100%;height:602px;">';
                                                        echo '    </em>';
                                                        echo '</div>';
                                                        //echo '        <h3><p style="text-align: center"> <strong>'.$news->image[$i]->keterangan.'</strong></p></h3>';
                                                        //echo '<img src="'.env('APP_URL').'/public/storage/'.$news->image[$i]->path.'" alt="" style="min-width:100%;">';
                                                        echo '</div>';
                                                    }else{
                                                        echo '<div class="item">';
                                                        echo '<div class="recent-work-item">';
                                                        echo '    <em>';
                                                        echo '            <img src="'.env('APP_URL').'/public/storage/'.$news->image[$i]->path.'" alt="" style="width:100%;height:602px;">';
                                                        echo '    </em>';
                                                        echo '</div>';
                                                        //echo '        <h3><p style="text-align: center"> <strong>'.$news->image[$i]->keterangan.'</strong></p></h3>';
                                                        //echo '<img src="'.env('APP_URL').'/public/storage/'.$news->image[$i]->path.'" style="min-width:100%;">';
                                                        echo '</div>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!-- Carousel nav -->
                                            <a class="carousel-control left" href="#carousel-example-generic" data-slide="prev">
                                                <i class="fa fa-angle-left"></i>
                                            </a>
                                            <a class="carousel-control right" href="#carousel-example-generic" data-slide="next">
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="front-carousel">
                                        <div id="myCarousel" class="carousel slide">
                                            <!-- Carousel items -->

                                        </div>
                                    </div>
                                    <!-- END CAROUSEL -->
                                </div>
                                <?php echo '<p style="text-align:justify;font-size: 14px">'.$news->isi.'</p>'; ?>
                                <hr>
                                <?php
                                        if (count($news->file) > 0){    ?>
                                <h2>File</h2>
                                <div class="row mix-grid thumbnails">
                                    <?php
                                        $num = count($news->file);
                                        for($i=0;$i<$num;$i++){
                                            echo '<div class="col-md-1 col-sm-1 mix category_1 mix_all" style="display: block; opacity: 1; ">';
                                            echo '<div class="mix-inner">';
                                            $arrFiles = explode('.',$news->file[$i]->file);
                                            switch ($arrFiles[1]){
                                                case 'jpg':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'JPG':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'jpeg':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'JPEG':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'png':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'PNG':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'bmp':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'BMP':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'tiff':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'TIFF':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'gif':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'GIF':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$news->file[$i]->path.'" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'pdf':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'doc':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'docx':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'xls':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'xlsx':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'ppt':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                                case 'pptx':
                                                    echo '<a class="mix-link" href="'.env('APP_URL').'/general/berita/'.$news->file[$i]->id.'/download/'.$news->judul.'"/>';
                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" class="img-responsive" style="width:100%;height:100%"/>';
                                                    echo '</a>';
                                                    break;
                                            }
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    ?>
                                </div><hr>
                                <?php   }   ?>
                                <h2>Komentar</h2>
                                <div class="comments">
                                    <?php
                                        $num = count($news->comment);
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
                                                $date = new DateTime($news->comment[$i]->dates);
                                                echo '<h4 class="media-heading">'.$news->comment[$i]->name.'<span>'.$date->format('M').' '.$date->format('d').','.$date->format('Y').'</span></h4>';
                                                echo '<p>'.$news->comment[$i]->comments.'</p>';
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

                            <!-- BEGIN RIGHT SIDEBAR -->
                            <div class="col-md-3 col-sm-3 blog-sidebar">
                                <!-- CATEGORIES START -->
                                <!--<h2 class="no-top-space">Kategori Berita</h2>
                                <ul class="nav sidebar-categories margin-bottom-40">
                                    <li><a href="javascript:;">Utama (18)</a></li>
                                    <li><a href="javascript:;">Inovasi (5)</a></li>
                                    <li><a href="javascript:;">Teknologi (7)</a></li>
                                    <li><a href="javascript:;">Serba Serbi (3)</a></li>
                                </ul>-->
                                <!-- CATEGORIES END -->

                                <!-- BEGIN RECENT NEWS -->
                                <h2>Berita Terbaru</h2>
                                <div class="recent-news margin-bottom-10">
                                    @foreach($latestNews as $item)
                                        <div class="row margin-bottom-10">
                                            <div class="col-md-3">
                                                @if (count($item->image) > 0)
                                                    <img class="img-responsive" alt="" src="{{env('APP_URL')}}/public/storage/news/{{$item->image[0]->file300x300}}">
                                                @else
                                                    <img class="img-responsive" src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" alt="">
                                                @endif
                                            </div>
                                            <div class="col-md-9 recent-news-inner">
                                                <h3><a href="{{env('APP_URL')}}/general/berita/utama/{{$item->judul}}/{{$item->id}}">{{$item->judul}}</a></h3>
                                                <?php $isi = substr(strip_tags($item->isi),0,100); ?>
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
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/regular/pages/news/scripts/showBerita.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop