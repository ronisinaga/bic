@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/juri/css/nilai.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">

        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <form role="form">
                                <h3>Penilaian Juri</h3><hr>
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th>Judul Proposal</th>
                                        <th>Originalitas</th>
                                        <th>Reka Ulang</th>
                                        <th>Daya Tarik</th>
                                        <th>Nilai Tambah</th>
                                        <th>P. Pengembangan</th>
                                        <th>P. Ekspansi</th>
                                        <th>Potensi Bisnis</th>
                                        <th>Resiko Bisnis</th>
                                        <th>Rekomendasi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proposalJuri as $item)
                                    <tr>
                                        <td><?php echo $item->proposal->judul;?></td>
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
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/juri/scripts/nilai.js" type="text/javascript"></script>
@stop
