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
                <li><a href="{{route('general.kristanto')}}">Blog</a></li>
                <li class="active">{{$blog->judul}}</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <input type="hidden" id="id" name="id" value="{{$blog->id}}"/>
                    <input type="hidden" id="judul" name="judul" value="{{$blog->judul}}"/>
                    <h1>{{$blog->judul}}</h1><br><br>
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
                                                $num = count($blog->image);
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
                                                $num = count($blog->image);
                                                for($i=0;$i<$num;$i++){
                                                    if ($i == 0){
                                                        echo '<div class="item active">';
                                                        echo '<div class="recent-work-item">';
                                                        echo '    <em>';
                                                        echo '            <img src="'.env('APP_URL').'/public/storage/'.$blog->image[$i]->path.'" alt="" style="width:100%;height:602px;">';
                                                        echo '    </em>';
                                                        echo '</div>';
                                                        //echo '        <h3><p style="text-align: center"> <strong>'.$blog->image[$i]->keterangan.'</strong></p></h3>';
                                                        //echo '<img src="'.env('APP_URL').'/public/storage/'.$blog->image[$i]->path.'" alt="" style="min-width:100%;">';
                                                        echo '</div>';
                                                    }else{
                                                        echo '<div class="item">';
                                                        echo '<div class="recent-work-item">';
                                                        echo '    <em>';
                                                        echo '            <img src="'.env('APP_URL').'/public/storage/'.$blog->image[$i]->path.'" alt="" style="width:100%;height:602px;">';
                                                        echo '    </em>';
                                                        echo '</div>';
                                                        //echo '        <h3><p style="text-align: center"> <strong>'.$blog->image[$i]->keterangan.'</strong></p></h3>';
                                                        //echo '<img src="'.env('APP_URL').'/public/storage/'.$blog->image[$i]->path.'" style="min-width:100%;">';
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
                                <?php echo '<p style="text-align:justify;font-size: 14px">'.$blog->isi.'</p>'; ?>
                                <hr>
                                <h2>Komentar</h2>
                                <div class="comments">
                                    <?php
                                        $num = count($blog->comment);
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
                                                $date = new DateTime($blog->comment[$i]->dates);
                                                echo '<h4 class="media-heading">'.$blog->comment[$i]->name.'<span>'.$date->format('M').' '.$date->format('d').','.$date->format('Y').'</span></h4>';
                                                echo '<p>'.$blog->comment[$i]->comments.'</p>';
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
                                <!--<h2 class="no-top-space">Kategori Blog</h2>
                                <ul class="nav sidebar-categories margin-bottom-40">
                                    <li><a href="javascript:;">Utama (18)</a></li>
                                    <li><a href="javascript:;">Inovasi (5)</a></li>
                                    <li><a href="javascript:;">Teknologi (7)</a></li>
                                    <li><a href="javascript:;">Serba Serbi (3)</a></li>
                                </ul>-->
                                <!-- CATEGORIES END -->

                                <!-- BEGIN RECENT NEWS -->
                                <h2>Blog Terbaru</h2>
                                <div class="recent-blog margin-bottom-10">
                                    @foreach($latestBlog as $item)
                                        <div class="row margin-bottom-10">
                                            <div class="col-md-3">
                                                @if (count($item->image) > 0)
                                                    <img class="img-responsive" alt="" src="{{env('APP_URL')}}/public/storage/blog/{{$item->image[0]->file300x300}}">
                                                @else
                                                    <img class="img-responsive" src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" alt="">
                                                @endif
                                            </div>
                                            <div class="col-md-9 recent-blog-inner">
                                                <h3><a href="{{env('APP_URL')}}/blog/{{$item->judul}}">{{$item->judul}}</a></h3>
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
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/regular/pages/blog/scripts/show.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop