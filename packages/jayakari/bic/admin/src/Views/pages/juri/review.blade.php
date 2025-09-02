@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Review Statistik Penilaian Saya
                <small>Daftar proposal yang sudah dinilai</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal Sudah Nilai</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Review Statistik Penilaian Saya</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Proposal sudah nilai Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase"> Review Statistik Penilaian Saya</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th> No Proposal </th>
                                    <th> Proposal </th>
                                    <th>Originalitas</th>
                                    <th>Reka Ulang</th>
                                    <th>Daya Tarik</th>
                                    <th>Nilai Tambah</th>
                                    <th>P. Pengembangan</th>
                                    <th>P. Ekspansi</th>
                                    <th>Potensi Bisnis</th>
                                    <th>Resiko Bisnis</th>
                                    <th>Rekomendasi</th>
                                    <th> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $index = 1 ?>
                                @foreach($proposal as $item)
                                    <tr>
                                        <td>{{$index}}</td>
                                        <td>{{$item->proposal->id}}</td>
                                        <td><?php echo $item->nilai_1;?></td>
                                        <td><?php echo $item->nilai_2;?></td>
                                        <td><?php echo $item->nilai_3;?></td>
                                        <td><?php echo $item->nilai_4;?></td>
                                        <td><?php echo $item->nilai_5;?></td>
                                        <td><?php echo $item->nilai_6;?></td>
                                        <td><?php echo $item->nilai_7;?></td>
                                        <td><?php echo $item->nilai_8;?></td>
                                        <td><?php
                                            switch ($item->nilai_9){
                                                case 1:
                                                    echo 'A';
                                                    break;
                                                case 2:
                                                    echo 'B';
                                                    break;
                                                case 3:
                                                    echo 'C';
                                                    break;
                                                case 4:
                                                    echo 'D';
                                                    break;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo env('APP_URL'); ?>/admin/juri/proposal/{{$topikProposal[$index-1]->id}}/revisinilai" class="btn purple">
                                                <i class="fa fa-pencil"></i> Revisi Nilai </a>
                                        </td>
                                        <?php $index++; ?>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop