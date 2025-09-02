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
                    <table class="table table-striped table-bordered table-hover" id="allvideos">
                        <thead>
                        <tr>
                            <th>Video 1</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $item)
                            <tr>
                                <td>
                                    <div class="row video">
                                        <div class="col-md-3 col-sm-3">
                                            <?php
                                                $arrvideos = explode('=',$item->url_youtube);
                                                $url = env('APP_URL').'/videos/view?videoid='.$arrvideos[count($arrvideos)-1]
                                            ?>
                                            <a href="{{$url}}">
                                                <img src="http://img.youtube.com/vi/{{$arrvideos[count($arrvideos)-1]}}/hqdefault.jpg" alt="{{$item->keterangan}}" class="img-responsive" />
                                            </a>
                                        </div>
                                        <div class="col-md-9 col-sm-9">
                                            <a href="{{$url}}"><h4 class="margin-bottom-10"><b>{{$item->keterangan}}</b></h4></a>
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
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/videos/scripts/all.js" type="text/javascript"></script>
@stop