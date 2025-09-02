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
            <h3 class="page-title"> Manajemen Proposal
                <small>Proposal Revisi</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li style="color: red">
                        <?php echo $labels['TRP'] ?>
                    </li>
                </ul>
                <!--<div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Proposal Revisi Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>-->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase"> Daftar Proposal Revisi</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Kode </th>
                                    <th> Tanggal </th>
                                    <th> Judul </th>
                                    <th> Status </th>
                                    <th> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $index = 1;
                                ?>
                                @foreach($proposal as $item)
                                    <tr>
                                        <td> {{$index}} </td>
                                        <td> {{$item->id}}</td>
                                        <td>
                                            <?php
                                            $date = new DateTime($item->tgl_pembuatan);
                                            echo $date->format('d M Y H:i:s');
                                            ?>
                                        </td>
                                        <td><a href='<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/{{$item->id}}/4/masuk'>{{$item->judul}}</a></td>
                                        <td>{{$item->statusProposal->status}}</td>
                                        <?php
                                            if ($item->is_always_active == 1){
                                                echo '<td><a href="'.env('APP_URL').'/admin/reviewer/proposal/'.$item->id.'/sendEmail" class="btn blue"><i class="fa fa-send"></i> Kirim Pesan</a></td>';
                                            }else{
                                                $now = date('Y');
                                                $start = $date->format('Y');
                                                if ($now-$start >= 3){
                                                    echo '<td><a href="'. env('APP_URL').'/admin/reviewer/proposal/'.$item->id.'/sendDiscontinued" class="btn red"><i class="fa fa-trash"></i> Discontinued</a></td>';
                                                }else{
                                                    echo '<td><a href="'.env('APP_URL').'/admin/reviewer/proposal/'.$item->id.'/sendEmail" class="btn blue"><i class="fa fa-send"></i> Kirim Pesan</a></td>';
                                                }
                                            }
                                        ?>
                                    </tr>
                                    <?php $index++; ?>
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/scripts/masuk.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop