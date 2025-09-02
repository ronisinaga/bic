@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/index.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/portfolio.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <!-- BEGIN SLIDER -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover" id="allnews">
                        <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Berita</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $item)
                            <tr>
                                <td width="20%">
                                    @if (count($item->image) > 0)
                                        <a href="<?php echo env('APP_URL'); ?>/public/storage/<?php echo $item->image[0]->path ?>" class="fancybox-button" title="Image Title" data-rel="fancybox-button">
                                            <img class="img-responsive" src="<?php echo env('APP_URL'); ?>/public/storage/<?php echo $item->image[0]->path ?>" alt="">
                                        </a>
                                    @else
                                        <a href="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" class="fancybox-button" title="Image Title" data-rel="fancybox-button">
                                            <img src="<?php echo env('APP_URL'); ?>/public/storage/no_image.jpg" alt="">
                                        </a>
                                    @endif
                                </td>
                                <td width="80%">
                                    <h4 class="margin-bottom-10"><b>{{$item->judul}}</b></h4>
                                    <?php $isi = substr(strip_tags($item->isi),0,500); ?>
                                    <p class="margin-bottom-10"><?php echo $isi ?>...</p>
                                    <p><a class="more" href="<?php echo env('APP_URL'); ?>/general/berita/utama/{{trim($item->judul)}}/{{$item->id}}">Read more <i class="icon-angle-right"></i></a></p>
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
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/news/scripts/all.js" type="text/javascript"></script>
@stop