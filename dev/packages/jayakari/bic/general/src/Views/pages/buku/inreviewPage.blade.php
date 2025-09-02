@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/page.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/portfolio.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <!-- BEGIN SLIDER -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(count($isibuku) > 0)
                        <img src="{{asset('public/storage/icon/header_inreview.jpg')}}"/><br>
                        <table class="table table-striped table-bordered table-hover" id="tblResult">
                            <thead>
                            <tr style="background-color: #ffff00;color: #1e80a9">
                                <th>No</th>
                                <th> No Urut </th>
                                <th> Buku </th>
                                <th> Proposal </th>
                                <th> Halaman Ebook </th>
                                <th> Kategori ARN </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $index = 1; ?>
                            @foreach($isibuku as $item)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>{{$item->orders or $item->id_proposal.'-'}}</td>
                                    <td><a href="http://bicbook.innovation.id/111%20Inovasi%20Indonesia%202019/index.html" target="_blank">{{$item->buku_judul}}</a></td>
                                    <td><a href="http://bicbook.innovation.id/111%20Inovasi%20Indonesia%202019/index.html" target="_blank">{{$item->judul_lengkap}}</a></td>
                                    <td style="text-align: center"><h2><b>{{$item->page}}</b></h2></td>
                                    <td>{{$item->arn}}</td>
                                </tr>
                                <?php $index++; ?>
                            @endforeach
                            </tbody>
                        </table><br>
                    @else
                        <h2>Data proposal Inreview masih kosong</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/scripts/page.js" type="text/javascript"></script>
@stop