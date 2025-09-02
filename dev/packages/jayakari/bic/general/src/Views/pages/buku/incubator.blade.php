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
                    @if(count($bukuisi) > 0)
                        <h3>Inovator 100+ Inovasi Indonesia BIC</h3>
                        <table class="table table-striped table-bordered table-hover" id="tblResult">
                            <thead>
                            <tr style="background-color: #008395;color: #ffffff">
                                <th>No</th>
                                <th> Judul Proposal </th>
                                <th> Batch </th>
                                <th> Inovator </th>
                                <th> Link </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $index = 1; ?>
                            @foreach($bukuisi as $item)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>{{$item->judul_singkat}}</td>
                                    <td>{{$item->buku->batch->batch}}</td>
                                    <td>{{$item->inovator}}</td>
                                    <?php
                                        /*$nickname = '';

                                        if ($item->proposal->user->nickname <> null){
                                            $nickname = $item->proposal->user->nickname;
                                        }else{
                                            $nickname = $item->proposal->user->id;
                                        }*/
                                    ?>
                                    <td><a href="{{route('buku.inovasi',['nickname'=>$item->proposal->user->fullname])}}" target="_blank" class="btn btn-blue">Halaman Inovator</a></td>
                                </tr>
                                <?php $index++; ?>
                            @endforeach
                            </tbody>
                        </table><br>
                    @else
                        <p>Data proposal Inreview masih kosong</p>
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